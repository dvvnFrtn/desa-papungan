<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AspirasiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'judul' => $this->judul,
            'isi' => $this->isi,
            'penulis' => $this->nama,
            'isChecked' => intval($this->isChecked),
            'foto' => url('storage/aspirasi/' . $this->foto),
            'createdAt' => Carbon::parse($this->created_at)->format('d-M-Y'),
            'updatedAt' => Carbon::parse($this->updated_at)->format('d-M-Y')
        ];
    }
}
