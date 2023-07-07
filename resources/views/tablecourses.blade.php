@extends('layouts.layout')
@section('content')
    <div class=" tableC">
       <form class="form-search" >
        <input type="text" id="search" placeholder="Search..." class="">
       <span class="icon-search"><i class="fa-solid fa-magnifying-glass"></i></span>
       </form>
        
        <table class="table  ">
            <thead>
                <tr>
                    <td>Check All <input type="checkbox" id="checkall" name="checkall"> <button id="btnAll" class="btn btn-danger">Delete Selected</button></td>
                    <td>Name</td>
                    <td>Description</td>
                    <td>Start Date</td>
                    <td>End Date</td>
                    <td>Event</td>
                </tr>
                
            </thead>
            <tbody id="renderTB"  >
                @foreach ($courses as $item)
                <tr>
                    <td> <input type="checkbox" data-item="{{$item->id}}" class="checklist"></td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->desciption}}</td>
                    <td>{{$item->startdate}}</td>
                    <td>{{$item->enddate}}</td>
                    <td><button class="btn btn-primary">Edit</button> | <button data-item="{{$item->id}}" class="btn btn-danger btnDelete">Delete</button></td>
                </tr>
                @endforeach
            </tbody>
        </table> 
        <div>
            <ul>
                <li class="rounded-circle page"><span>Pre</span></li>
                <li class="rounded-circle page active"><span>1</span></li>
                <li class="rounded-circle page"><span>2</span></li>
                <li class="rounded-circle page"><span>3</span></li>
                <li class="rounded-circle page"><span>Next</span></li>
            </ul>
        </div>
    </div>
    <form class="form-control text-center form-c mt-5">
        <h1>ADD COURSES</h1>
        <div class="text-right">
            <label for="name" class="d-block">
                <span>Name:</span>
                <input type="text"  class="mt-3 ml-5 info" placeholder="Name..." id="name" name="name" >
            </label>
            <label for="start" class="d-block">
                <span>Start Date:</span> 
                <input type="datetime-local"  class="mt-3 ml-5 info" placeholder="Start Date..." id="start" name="start">
            </label>
            <label for="end" class="d-block">
                <span>End Date:</span> 
                <input type="datetime-local"  class="mt-3 ml-5 info" placeholder="End Date..." id="end" name="end">
            </label>
            <label for="desciption" class="d-block">
                <span>Description:</span>
                <textarea name="desciption" id="desciption" class="mt-3 ml-5 info" cols="30" rows="10"></textarea>
            </label>
            <div class="text-center">
                <button class="btn btn-primary" id="add">Add</button>
            <button class="btn btn-primary" id="cancel">Cancel</button>
            </div>
        </div>
    </form>
    <div class="n-sc"> 
        <div class="success">
            <div class="box-sc">
                <i class="fa-solid fa-check"></i>
            </div>
            <div class="content-succsess">
                <div class="tiltle">
                    Success
                </div>
                <div class="decription-sc">
                    Add course successfully!
                </div>
            </div>
        </div>
    </div>
    <div class="n-er">
        <div class="error">
            <div class="box-er">
                <i class="fa-solid fa-exclamation"></i>
            </div>
            <div class="content-error">
                <div class="tiltle">
                    Warning
                </div>
                <div class="decription-sc">
                    Add course don't successfully!
                </div>
            </div>
        </div>
    </div>
@endsection