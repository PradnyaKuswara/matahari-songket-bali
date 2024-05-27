<?php

namespace App\Http\Controllers;

use App\Http\Requests\FaqRequest;
use App\Services\MailService;
use Masmerise\Toaster\Toaster;

class AboutController extends Controller
{
    protected $mailService;

    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    public function index()
    {
        return view('pages.about');
    }

    public function faq(FaqRequest $request)
    {
        $this->mailService->faq($request->validated());

        Toaster::success('Your question has been sent successfully');

        return redirect()->back();
    }
}
