<!DOCTYPE html>
<html lang="en" ng-app="asideMenuDemo">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>User Module</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.js"></script>
        <script src="https://rawgit.com/mahmutduva/6c251e5fce9f69221f5c82d27bb5d549/raw/9bc9dc6ea65a75f97fc42a20fe5deeb4c46bc468/aside-menu.min.js"></script>
        <script src="js/demo.js"></script>
        <link rel="stylesheet" href="css/style.css">
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
        <script src="http://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"</script>
        <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <script src="js/bootstrap.min.js"></script>
        <script src="js/usermodule.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js"></script>

    </head>
    <body>

    <aside-menu id="sag2" side="right" width="300px" is-backdrop="true" push-content="false">
        <form>
            <div class="form-group ui-widget">
                <label>User Name</label>
                <input type="text" class="form-control" id="username" data-provide="typeahead" placeholder="User Name" >
            </div>
            <div class="form-group">
                <label>Contact</label>
                <input type="text" class="form-control" id="contact" placeholder="Contact">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" id="email" placeholder="Email">
            </div><br><br>
            <button type="submit" class="btn btn-success" id="save_data">Save</button>&nbsp;&nbsp;
            <button type="reset" class="btn btn-primary">Clear</button>

        </form>
        <div class="alert alert-success" role="alert" id="alert_success"></div>
        <div class="alert alert-danger" role="alert" id="alert_fail"></div>
    </aside-menu>

    <aside-menu-content>
        <div class="row">
            <div class="col-md-11">
                <div class="col-md-12">
                    <div class="input-group">
                        <button class="btn btn-info btn-lg form-control" type="button" style="height: 40px">User Information</button>
                        <span class="input-group-btn">
                            <img src="img/arrow_up.png" type="button" class="usertable-fade" data-target="#user_table" data-toggle="collapse" aria-controls="user_table">
                        </span>
                    </div>
                </div>
                <div class="col-md-12 " id="user_table" class="collapse"></div>
                <div class="col-md-12">
                    <div class="input-group">
                        <button class="btn btn-info btn-lg form-control" type="button" style="height: 40px">User History</button>
                        <span class="input-group-btn">
                            <img src="img/arrow_up.png" type="button" class="userhistory-fade" data-target="#user_history" data-toggle="collapse" area-expanded="false" aria-controls="user_history">
                        </span>
                    </div>
                </div>
                <div class="col-md-12 " id="user_history" class="collapse"></div>
            </div>

            <div class="btn-block col-md-1">
                <button type="button" aside-menu-toggle="sag2" class="button"><img src="img/arrow.png"></button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="alert alert-success col-md-6 hidden" role="alert" id="alertDeleteSuccess"></div>
        </div>
        
    </aside-menu-content>

    <div class="modal fade" id="alertToDelete" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="deleteAlert">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label class="control-label">Are you sure to delete this table ?</label>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="noToDelete" aria-hidden="true">No</button>
                    <button type="button" class="btn btn-primary" id="yesToDelete">Yes</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>