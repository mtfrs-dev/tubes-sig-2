<?php

namespace App\Http\Livewire;

use App\Models\LocationObject;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class LocationObjectTable extends DataTableComponent
{
    protected $model = LocationObject::class;

    protected $listeners = ['deleteLocation'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSortingEnabled();
        $this->setTableWrapperAttributes([
            'class' => 'custom-scrollbar',
        ]);
    }

    public function builder(): Builder
    {
        return LocationObject::query()
            ->leftJoin('ratings', 'location_objects.id', '=', 'ratings.location_object_id')
            ->select('location_objects.*', DB::raw('COALESCE(AVG(ratings.score), 0) as rating'))
            ->groupBy('location_objects.id');
    }

    // LOCATION DETAIL
    public function showDetailModal($id)
    {
        $location = LocationObject::query()
            ->leftJoin('ratings', 'location_objects.id', '=', 'ratings.location_object_id')
            ->select('location_objects.*', DB::raw('COALESCE(AVG(ratings.score), 0) as rating'))
            ->groupBy('location_objects.id')
            ->where('location_objects.id', $id)
            ->first();
        $this->dispatchBrowserEvent('showDetail:location', [
            'asset'     => $location->asset_link,
            'name'      => $location->name,
            'type'      => $location->type,
            'address'   => $location->address,
            'phone'     => $location->phone,
            'latitude'  => $location->latitude,
            'longitude' => $location->longitude,
            'rating'    => $location->rating,
        ]);
    }

    // MEDICINE DELETION
    public function deleteConfirm($id)
    {
        $this->dispatchBrowserEvent('delete:location', [
            'id' => $id
        ]);
    }

    public function deleteLocation($id)
    {
        LocationObject::find($id)->delete();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(auth()->user()->role != "USER"),
            Column::make("Nama", "name")
                ->sortable()
                ->searchable(),
            Column::make("Jenis", "type")
                ->sortable(),
            Column::make("Alamat", "address")
                ->sortable()
                ->hideIf(auth()->user()->role != "USER"),
            Column::make("No. Telepon", "phone")
                ->sortable(),
            Column::make("Rating")
                ->label(
                    function ($row) {
                        return view('components.datatable.location-rating', ['rating' => $row->rating]);
                    }
                )
                ->collapseOnTablet(),
            Column::make("Asset link", "asset_link")
                ->sortable()
                ->hideIf(auth()->user()->role != "USER"),
            Column::make("Latitude", "latitude")
                ->sortable()
                ->hideIf(auth()->user()->role != "USER"),
            Column::make("Longitude", "longitude")
                ->sortable()
                ->hideIf(auth()->user()->role != "USER"),
            Column::make("Geometry", "geometry")
                ->sortable()
                ->hideIf(auth()->user()->role != "USER"),
            Column::make("Aksi", "id")
                ->format(
                    fn($value) => view('components.datatable.actions')->withValue($value)
                )
                ->hideIf(auth()->user()->role != "ADMIN"),
        ];
    }
}
