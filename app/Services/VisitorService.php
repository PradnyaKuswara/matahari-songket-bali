<?php

namespace App\Services;

use App\Models\Visitor;
use App\Models\VisitorMeta;
use Illuminate\Support\Facades\DB;

class VisitorService
{
    public function __construct(
        private string|Visitor $type,
        private object $model,
    ) {
    }

    /**
     * increment visitor data
     */
    public function increment(): self
    {
        $this->set($this->model);

        return $this;
    }

    /**
     * set visitor data
     */
    private function set(object $data): void
    {
        DB::beginTransaction();

        (string) $ipAddress = request()->ip();

        (bool) $alreadyVisited = Visitor::query()
            ->where('type', $this->type)
            ->where('ip_address', $ipAddress)
            ->whereRelation('visitorMeta', 'identity', '=', (int) $data->id)
            ->exists();

        if ($alreadyVisited) {
            return;
        }

        try {
            (object) $visitor = Visitor::create([
                'type' => $this->type,
                'ip_address' => $ipAddress,
            ]);

            VisitorMeta::create([
                'visitor_id' => (int) $visitor->id,
                'identity' => (int) $data->id,
                'link' => request()->url(),
                'slug' => (string) $data->slug,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            info($th);
        }
    }

    /**
     * get total visitors per-site
     */
    public function getVisitorCountPerSite(): int
    {
        return Visitor::query()
            ->where('type', $this->type)
            ->whereRelation('visitorMeta', 'identity', '=', $this->model->id)
            ->count();
    }
}
