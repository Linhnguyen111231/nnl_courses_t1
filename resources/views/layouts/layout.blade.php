<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="main ">
        <div class="row">
            <div class="col-md-2">
                <div class="func">
                    <ul class="list-group">
                        <li class="list-group-item point active" aria-current="true">Table</li>
                        <li class="list-group-item point">Add</li>
                      </ul>
                </div>
            </div>
           <div class="col-md-10">
            <div class="container">
            
                @yield('content')
                @yield('add')
            </div>
           </div>
        </div>
    </div>
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
                    Successfully!
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
                    Don't successfully!
                </div>
            </div>
        </div>
    </div>
    <div class="success-form">
        <div class="message">
            <div class="title mt-5">
                <i class="fa-solid fa-check"></i>
                
            </div>
            <div class="content-succsess">
                <div class="title" >
                    Success
                </div>
                <div class="decription-sc mb-3">
                    Add course successfully!
                </div>
            </div>
            <div class="mb-5">
                <button class="btn s-okay btn-primary">OKAY</button>
                <button class="btn s-ctn btn-primary mr-3">Tiếp Tục</button>
            </div>
        </div>
    </div>
    <div class="error-form">
        <div class="message">
            <div class="title mt-5">
                <i class="fa-solid fa-exclamation"></i>

                
            </div>
            <div class="content-succsess">
                <div class="title" >
                    Error
                </div>
                <div class="decription-sc mb-3">
                    Add course don't successfully!
                </div>
            </div>
            <div class="mb-5">
                
                <button class="btn btn-primary er-ctn mr-3">Tiếp Tục</button>
            </div>
        </div>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>