<?php
require_once 'startup.php';
/*$rootDir = realpath(dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;

spl_autoload_register(function ($className){

    $file = $GLOBALS["rootDir"]."classes".DIRECTORY_SEPARATOR.$className.".php";
    if(!file_exists($file)){
        return false;
    }
    else{
        require_once $file;
        return true;
    }
});*/

?>

<head>
    <title>AJAX</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="code.jquery.com_jquery-3.7.0.js"></script>
    <link rel="stylesheet" href="toastr/toastr.css">
    <script src="toastr/toastr.js"></script>
    <script src="site.js"></script>
</head>

<body>

    <div>
        <h1>
            Hello World!
        </h1>
    </div>

<div style="margin: 25px">
    <table id="_people" class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>


<button id="openModalWnd" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalWnd">
    New Person
</button>
<div class="modal fade" id="modalWnd">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Personal data</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3 row">
                    <label for="firstName" class="col-sm-3 col-form-label">First Name:</label>
                    <div class="col-sm-9">
                        <input id="firstName" name="firstName" class="form-control" />
                    </div>
                </div>
                <div class="form-group mb-3 row">
                    <label for="lastName" class="col-sm-3 col-form-label">Last Name:</label>
                    <div class="col-sm-9">
                        <input id="lastName" name="lastName" class="form-control" />
                    </div>
                </div>
                <div class="form-group mb-3 row">
                    <label for="eMail" class="col-sm-3 col-form-label">E Mail:</label>
                    <div class="col-sm-9">
                        <input type="email" id="eMail" name="eMail" class="form-control" />
                    </div>
                </div>
                <div class="form-group mb-3 row">
                    <label for="phone" class="col-sm-3 col-form-label">Phone:</label>
                    <div class="col-sm-9">
                        <input type="tel" id="phone" name="phone" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="_btnSave" type="button" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalDelete">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete personal data</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="_id_delete" />
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-5 ms-auto">
                            <div >
                                <img src="./images/noPhoto.jpg" alt="noPhoto" class="w-100 h-75">
                            </div>
                        </div>
                        <div class="col-md-7 ms-auto">
                            <div class="form-group mb-3 row">
                                <label for="firstName_delete" class="col-sm-3 col-form-label">First Name:</label>
                                <div class="col-sm-9">
                                    <input id="firstName_delete" name="firstName" class="form-control" readonly />
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label for="lastName_delete" class="col-sm-3 col-form-label">Last Name:</label>
                                <div class="col-sm-9">
                                    <input id="lastName_delete" name="lastName" class="form-control" readonly />
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label for="eMail_delete" class="col-sm-3 col-form-label">E Mail:</label>
                                <div class="col-sm-9">
                                    <input type="email" id="eMail_delete" name="eMail" class="form-control" readonly />
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <label for="phone_delete" class="col-sm-3 col-form-label">Phone:</label>
                                <div class="col-sm-9">
                                    <input type="tel" id="phone_delete" name="phone" class="form-control" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button id="_btnDelete" type="button" class="btn btn-primary" data-bs-dismiss="modal">Delete</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="modalUpdate">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update personal data</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="_id_update" />
                <div class="form-group mb-3 row">
                    <label for="firstName_update" class="col-sm-3 col-form-label">First Name:</label>
                    <div class="col-sm-9">
                        <input id="firstName_update" name="firstName" class="form-control" />
                    </div>
                </div>
                <div class="form-group mb-3 row">
                    <label for="lastName_update" class="col-sm-3 col-form-label">Last Name:</label>
                    <div class="col-sm-9">
                        <input id="lastName_update" name="lastName" class="form-control" />
                    </div>
                </div>
                <div class="form-group mb-3 row">
                    <label for="eMail_update" class="col-sm-3 col-form-label">E Mail:</label>
                    <div class="col-sm-9">
                        <input type="email" id="eMail_update" name="eMail" class="form-control" />
                    </div>
                </div>
                <div class="form-group mb-3 row">
                    <label for="phone_update" class="col-sm-3 col-form-label">Phone:</label>
                    <div class="col-sm-9">
                        <input type="tel" id="phone_update" name="phone" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="_btnSave_update" type="button" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</body>

