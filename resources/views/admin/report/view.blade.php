<div class="row">
    <div class="col-md-12 table-responsive">
        <table class="table table-bordered table-striped">
            <tr>
                <td>Created At</td>
                <td><?= date( 'm-d-Y H:i', strtotime($model->created_at)) ?></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><?= $model->name ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?= $model->email ?></td>
            </tr>
            <tr>
                <td>Phone</td>
                <td><?= $model->phone ?></td>
            </tr>
            <tr>
                <td>Subject</td>
                <td><?= $model->subject ?></td>
            </tr>
            <tr>
                <td>Message</td>
                <td><?= nl2br($model->message) ?></td>
            </tr>
        </table>
    </div>
</div>