<?php

use App\Models\Branch;
use Illuminate\Support\Facades\Session;

function getCurrentBranch(){
    return (Session::get('branch')) ? Branch::find(Session::get('branch')) : Branch::find(1);
}

?>