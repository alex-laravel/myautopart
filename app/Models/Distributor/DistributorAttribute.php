<?php


namespace App\Models\Distributor;


trait DistributorAttribute
{
    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return
            $this->getShowButtonAttribute() .
            $this->getEditButtonAttribute();
//            $this->getDeleteButtonAttribute();
    }

    /**
     * @return string
     */
    private function getShowButtonAttribute()
    {
        return '<a href="' . route('backend.distributors.show', $this) . '" class="btn btn-sm btn-info"><i class="fas fa-search"></i> ' . trans('buttons.general.view') . '</a> ';
    }

    /**
     * @return string
     */
    private function getEditButtonAttribute()
    {
        return '<a href="' . route('backend.distributors.edit', $this) . '" class="btn btn-sm btn-warning"><i class="far fa-edit"></i> ' . trans('buttons.general.edit') . '</a> ';
    }

//    /**
//     * @return string
//     */
//    private function getDeleteButtonAttribute()
//    {
//        return '<a href="' . route('backend.version-containers.destroy', $this->id) . '"
//             data-method="delete"
//             data-trans-button-cancel="' . trans('buttons.general.cancel') . '"
//             data-trans-button-confirm="' . trans('buttons.general.crud.delete') . '"
//             data-trans-title="' . trans('alerts.general.are_you_sure') . '"
//             class="btn btn-sm btn-danger"><i class="fa fa-trash" title="' . trans('buttons.general.crud.delete') . '"></i></a> ';
//    }
}
