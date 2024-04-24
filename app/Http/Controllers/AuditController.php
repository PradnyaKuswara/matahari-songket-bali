<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\User;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function index(Request $request)
    {
        $audits = Audit::query();

        $audits = $audits->orderBy('created_at', 'desc');

        /** @var \Illuminate\Pagination\CursorPaginator $audits */
        $audits = $audits->paginate(10);

        $audits->through(function (Audit $audit) {
            if (! empty($audit->user_id)) {
                $audit['user_name'] = User::find($audit->user_id)->name ?? '';
            }

            $audit['type'] = str(str($audit['auditable_type'])->classBasename())->headline();

            return $audit;
        });

        return view('pages.admin.audits.index', [
            'audits' => $audits,
        ]);
    }
}
