@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add bulk users</div>

                <div class="panel-body">
                     <form  action="user/upload_users" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="col-xs-4"> 
                                    <label class="control-label">Select Upload File</label>
                                </div>
                                <div class="col-xs-8">
                                     <input type="file" name="fileToUpload" id="fileToUpload" accept=".xlsx">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <br><button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
