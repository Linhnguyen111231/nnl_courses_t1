@extends('layouts.layout')
@section('content')
    <div class=" tableC mt-5">
        <h1 class="text-center">COURSES</h1>
       <form class="form-search" >
        <input type="text" id="search" placeholder="Search..." class="">
       <span class="icon-search"><i class="fa-solid fa-magnifying-glass"></i></span>
       </form>
        
        <table class="table  ">
            <thead>
                <tr>
                    <td>Check All <input type="checkbox" id="checkall" name="checkall"> <button id="btnAll" class="btn btn-danger">Delete Selected</button></td>
                    <td style="white-space: nowrap">Name <span id="sortAZ"><i class="fa-solid fa-arrow-up-a-z"></i></span> | <span id="sortZA"><i class="fa-solid fa-arrow-down-z-a"></i></span></td>
                    <td class="mbl-none">Description</td>
                    <td class="mbl-none">Start Date</td>
                    <td class="mbl-none">End Date</td>
                    <td>Event</td>
                </tr>
                
            </thead>
            <tbody id="renderTB"  >
            
                
            </tbody>
        </table> 
        <div>
            <ul class="page-url">
                <li class="rounded-circle page"><span>Pre</span></li>
                <li class="rounded-circle page active"><span>1</span></li>
                <li class="rounded-circle page"><span>2</span></li>
                <li class="rounded-circle page"><span>3</span></li>
                <li class="rounded-circle page"><span>Next</span></li>
            </ul>
        </div>
    </div>
    <form class="form-control text-center form-c mt-5">
        @csrf
        <h1>ADD COURSES</h1>
        <div class="text-right">
            <label for="name" class="d-block">
                <span>Name:</span>
                <div>
                    <input type="text"  class="mt-3 ml-5 info" placeholder="Name..." id="name" name="name" >
                <div class="error-text"></div>
                </div>
            </label>
            <label for="start" class="d-block">
                <span>Start Date:</span> 
                <div>
                    <input type="datetime-local"  class="mt-3 ml-5 info" placeholder="Start Date..." id="start" name="start">
                <div class="error-text"></div>
                </div>
           
            </label>
            <label for="end" class="d-block">
                <span>End Date:</span> 
                <div>
                    <input type="datetime-local"  class="mt-3 ml-5 info" placeholder="End Date..." id="end" name="end">
                <div class="error-text"></div>
                </div>
            
            </label>
            <label for="desciption" class="d-block">
                <span>Description:</span>
                <div>
                    <textarea name="desciption" id="desciption" class="mt-3 ml-5 info" cols="30" rows="10"></textarea>
                <div class="error-text"></div>
                </div>

            </label>
            <div class="text-center">
                <button class="btn btn-primary" id="add">Add</button>
            <button class="btn btn-danger" id="cancel">Cancel</button>
            </div>
        </div>
    </form>
    <div class="edit-item">
        <form class="form-control text-center form-edit mt-5">
            @csrf
            <h1>EDIT COURSES</h1>
            <div class="text-right">
                <label for="nameED" class="d-block">
                    <span>Name:</span>
                    <div>
                        <input type="text"  class="mt-3 ml-5 info inforEdit" placeholder="Name..." id="nameED" name="nameEdit" >
                    <div class="error-text"></div>
                    </div>
                </label>
                <label for="startED" class="d-block">
                    <span>Start Date:</span> 
                    <div>
                        <input type="datetime-local"  class="mt-3 ml-5 info inforEdit" placeholder="Start Date..." id="startED" name="startEdit">
                    <div class="error-text"></div>
                    </div>
               
                </label>
                <label for="endED" class="d-block">
                    <span>End Date:</span> 
                    <div>
                        <input type="datetime-local"  class="mt-3 ml-5 info inforEdit" placeholder="End Date..." id="endED" name="endEdit">
                    <div class="error-text"></div>
                    </div>
                
                </label>
                <label for="desciptionED" class="d-block">
                    <span>Description:</span>
                    <div>
                        <textarea name="desciption" id="desciptionED" class="mt-3 ml-5 info inforEditDescription" cols="30" rows="10"></textarea>
                    <div class="error-text"></div>
                    </div>
    
                </label>
                <div class="text-center">
                    <button class="btn btn-primary" id="update">Update</button>
                <button class="btn btn-danger" id="cancelEdit">Cancel</button>
                </div>
            </div>
        </form>
    </div>
    
    
@endsection