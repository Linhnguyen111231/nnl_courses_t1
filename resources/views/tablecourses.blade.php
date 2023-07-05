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
                    <td>Check all <input type="checkbox" id="checkall" name="checkall"></td>
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
                    <td> <input type="checkbox" class="checklist" name="checkall"></td>
                    <td>{{$item->name}}</td>
                    <td>Hello</td>
                    <td>1</td>
                    <td>1</td>
                    <td><button class="btn btn-primary">Edit</button> | <button class="btn btn-danger">Delete</button></td>
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
    <form class="form-control text-center form-c">
        <div class="text-right">
            <label for="name" class="d-block">
                Name: 
                <input type="text"  class="ml-3" placeholder="Name..." id="name" name="name" >
            </label>
            <label for="desciption" class="d-block">
                Description: 
                <input type="text"  class="ml-3" placeholder="Description..." id="desciption" name="desciption">
            </label>
            <label for="start" class="d-block">
                Start Date: 
                <input type="datetime-local"  class="ml-3" placeholder="Start Date..." id="start" name="start">
            </label>
            <label for="end" class="d-block">
                Start Date: 
                <input type="datetime-local"  class="ml-3" placeholder="End Date..." id="end" name="end">
            </label>
            <div class="text-center">
                <button class="btn btn-primary" id="add">Add</button>
            <button class="btn btn-primary" id="cancel">Cancel</button>
            </div>
        </div>
    </form>
@endsection