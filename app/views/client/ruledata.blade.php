<?php
if($rules==null ||($rules!=null && count($rules)==0)) {
    echo "Không có luật nào !";
} else {
?>

<table class="table table-striped table-bordered">
    <thead>
    <tr class="active" style="background-color: #2a6496;">
        <td style="text-align: center;">#Id</td>
        <td style="text-align: center;">Đầu trận </td>
        <td style="text-align: center;">45+HT </td>
        <td style="text-align: center;">Báo màu</td>
        <td style="text-align: center;">Công cụ </td>
    </tr>
    </thead>
    <tbody>
    @foreach($rules as $rule)
        <?php
        $color="danger";
        $after_time=$rule->after_odd;
        $after_time='<font color="blue">'.$rule->after_odd.'</font>';
        if($rule->color==3) {
            $color="danger";
        } else {
            $color="warning";
        }
                if($rule->type==4) {
                    $after_time='<font color="red">'.'Tăng chấp'.'</font>';;
                } elseif($rule->type==5) {
                    $after_time='<font color="blue">'.$rule->after_odd.'</font><font color="red"> Trở lên </font>';;
                }
        ?>
        <tr>
            <td style="text-align: center;">{{$rule->id}}</td>
            <td style="text-align: center;" ><font color="green"> {{$rule->start_odd}}</font></td>
            <td style="text-align: center;"><font color="blue"> {{$after_time}}</font></td>
            <td style="text-align: center;" class="{{$color}}" >
            </td>
            <td style="text-align: center;">
                <div class="btn-group">
                    <button class="btn btn-small btn-sm btn-warning" data-loading-text="Đang cập nhật..." onclick="SettingModule.editItems(this,'{{$rule->id}}');">Edit | <span class="fa fa-edit"></span></button>
                    <button class="btn btn-small btn-sm btn-danger" data-loading-text="Đang xoá..." onclick="SettingModule.deleteItem(this,'{{$rule->id}}');">Delete | <span class="fa fa-trash-o"></span></button>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<?php } ?>