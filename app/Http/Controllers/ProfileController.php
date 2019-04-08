<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Lesson;
use App\Repositories\TimetableRepository;
use App\ViewModels\ProfileViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller {
    private $ttr;

    public function __construct(TimetableRepository $ttr) {
        $this->ttr = $ttr;
    }

    public function index() {
        return view(
            "profile",
            new ProfileViewModel($this->ttr, Auth::user())
        );
    }
}
