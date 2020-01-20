<?php

namespace KiryaDev\Admin\Http\Requests;


class DeleteResourceRequest extends DetailResourceRequest
{
    public function authorize()
    {
        return $this->resource()->authorizedTo('delete', $this->object());
    }
}