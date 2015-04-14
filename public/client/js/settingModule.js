/**
 * Created by michael on 4/8/15.
 */
var SettingModule = {
    urlApi: '/football/',
    rule_type_list: "#rule_type_list",
    rule_type_id: 0,
    selected_rule_id:0,
    LoadRuleData: function (myself, data_type) {
        this.rule_type_id = data_type;
        $("#rule_type_list").find('a').removeClass("active");
        $(myself).addClass("active");
        this.refreshData(data_type);
    },
    refreshData: function(data_type) {
        $.ajax({
            url: this.urlApi + 'settings/data/' + data_type,
            type: "GET",
            beforeSend: function () {
                $("#rule_data").html('Loading...');
                $("#spanError").hide();

            },
            success: function (result) {
                $("#rule_data").html(result);
                $("#btnAdd").show();
            },
            error: function (jqXHR) {
                $("#spanError").show();
                $("#spanError").html(jqXHR);
            }
        });
    },
    editItems: function (myself, resource_id) {
        this.selected_rule_id=resource_id;
        $("#editrule").modal('show');
        $.ajax({
            url: this.urlApi+'rules/'+resource_id+'/editview',
            data: {rule_type:this.rule_type_id},
            type: "GET",
            beforeSend: function () {
                $('#editbody').html("Đang tải dữ liệu...");
            },
            success: function (result) {
                $('#editbody').html(result);
            },
            error: function (jqXHR) {
                alert(jqXHR.responseText);
            }
        });
    },
    saveRule : function(myself) {
        var that=this;
        var start_odd = $('#start_odd_edit').val();
        var after_odd = $('#after_odd_edit').val();
        var rule_color = $('#rule_color_edit').val();


        $.ajax({
            url: this.urlApi + 'rules/'+this.selected_rule_id+'/edit',
            data: {start_odd: start_odd,after_odd:after_odd,rule_color:rule_color,data_type:this.rule_type_id},
            type: "PUT",
            beforeSend: function () {
                $(myself).button('Editing...');
                $("#spanError2").hide();
            },
            success: function (result) {
                if(result.error==0) {
                    $('#editrule').modal('hide');
                    that.refreshData(that.rule_type_id);
                } else {
                    $("#spanError2").show();
                    $("#spanError2").html(result.html);
                }

            },
            error: function (jqXHR) {
                $("#spanError2").show();
                $("#spanError2").html(jqXHR);
            }
        });
        return false;
    },
    deleteItem: function (myself, resource_id) {
        that = this;
        if (confirm('Bạn muốn xoá luật này ?')) {
            $.ajax({
                url: this.urlApi + '/rules/' + resource_id + '/delete',
                type: "POST",
                beforeSend: function () {
                    $(myself).button('Đang xoá...');
                },
                success: function (result) {
                    if(result.error==0) {
                        $(myself).closest("tr").remove();
                    } else {
                        alert(result.html);
                        $(myself).button('Xoá');
                    }

                },
                error: function (jqXHR) {
                    alert(jqXHR.responseText);
                }
            });
        }
    },
    showAddDialog: function (myself) {
        $("#addrule").modal('show');
        $.ajax({
            url: this.urlApi+'rules/addView',
            data: {rule_type:this.rule_type_id},
            type: "GET",
            beforeSend: function () {
                $('#newbody').html("Đang tải dữ liệu...");
            },
            success: function (result) {
                $('#newbody').html(result);
            },
            error: function (jqXHR) {
                alert(jqXHR.responseText);
            }
        });
    },
    addRule: function (myself) {
        var that=this;
        var start_odd = $('#start_odd').val();
        var after_odd = $('#after_odd').val();
        var rule_color = $('#rule_color').val();

        $.ajax({
            url: this.urlApi + 'rules',
            data: {start_odd: start_odd,after_odd:after_odd,rule_color:rule_color,type:this.rule_type_id},
            type: "POST",
            beforeSend: function () {
                $(myself).button('Adding...');
                $("#spanError1").hide();
            },
            success: function (result) {
                if(result.error==0) {
                    $('#addrule').modal('hide');
                    that.refreshData(that.rule_type_id);
                } else {
                    $("#spanError1").show();
                    $("#spanError1").html(result.html);
                }

            },
            error: function (jqXHR) {
                $("#spanError1").show();
                $("#spanError1").html(jqXHR);
            }
        });
        return false;
    },
    saveSoundSetting : function(myself) {

        var yellow_sound =0;
        if($('#yellow_sound').is(':checked')){
            yellow_sound=1;
        }
        var red_sound =0;
        if($('#red_sound').is(':checked')){
            red_sound=1;
        }

        $.ajax({
            url: this.urlApi + 'settings/sound',
            data: {yellow_sound: yellow_sound,red_sound:red_sound},
            type: "POST",
            beforeSend: function () {
                $(myself).button('Đang lưu...');
            },
            success: function (result) {
                if(result.error==0) {
                    $('#divresult').removeClass();
                    $('#divresult').addClass("alert");
                    $('#divresult').addClass("alert-success");
                    $('#divresult').html('Thành Công.');
                } else {
                    $('#divresult').removeClass();
                    $('#divresult').addClass("alert");
                    $('#divresult').addClass("alert-danger");
                    $('#divresult').html('Error:'+result.html);
                }
            },
            error: function (jqXHR) {
                alert(jqXHR.responseText)
            }
        });
        return false;

    },
    loadSoundSetting : function(myself) {
        $.ajax({
            url:this.urlApi+"settings/sound",
            type: "GET",
            beforeSend: function () {
                $('#divSoundSetting').html("Đang tải dữ liệu...");
            },
            success: function (result) {
                $('#divSoundSetting').html(result);
            },
            error: function (jqXHR) {
                alert(jqXHR.responseText);
            }

        });
    }
};
