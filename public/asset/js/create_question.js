let i = 1;
function hideShowQuest() {
    if (i === 1) {
        $("#question_").hide(200);
        $("#iconQuest").removeClass('fa-chevron-down');
        $("#iconQuest").addClass('fa-chevron-up');
        i = 0;
    } else {
        $("#question_").show(200);
        $("#iconQuest").removeClass('fa-chevron-up');
        $("#iconQuest").addClass('fa-chevron-down');
        i = 1;
    };
}

let b = 1;
function hideShowAnswer() {
    if (b === 1) {
        $("#option_").hide(200);
        $("#iconAnswer").removeClass('fa-chevron-down');
        $("#iconAnswer").addClass('fa-chevron-up');
        b = 0;
    } else {
        $("#option_").show(200);
        $("#iconAnswer").removeClass('fa-chevron-up');
        $("#iconAnswer").addClass('fa-chevron-down');
        b = 1;
    };
}

var JSONanswer = [];
                        $(function(){
                            var initAnswer = { row : 0 };
                            JSONanswer.push(initAnswer);
                            $("#JSONanswer").val(JSON.stringify(JSONanswer));
                        });

    function cloneAnswer() {
        // TOTAL ANSWER //
        var totalAnswer = $("#totalAnswer").val();
        totalAnswer++;
        $("#totalAnswer").val(totalAnswer);
        // JSON ANSWER //
        var newInit = { row : totalAnswer };
        JSONanswer.push(newInit);
        $("#JSONanswer").val(JSON.stringify(JSONanswer));
        // FOR ANSWER //
        var _html = '';
        var alph = alphabet(totalAnswer);
        _html += '<div class="row" id="rowAnswer'+totalAnswer+'">';
            _html += '<div class="col-sm-1">';
                _html += '<div id="chooseAnswer'+totalAnswer+'" class="chooseAnswer" onclick="chooseAnswer(\'' + totalAnswer + '\')"><span class="forAlph">'+alph+'</span></div>';
            _html += '</div>';
            _html += '<div class="col-sm-11">';
                _html += '<textarea class="form-control" style="height:150px" name="option_'+totalAnswer+'" id="textareaBlank'+totalAnswer+'"></textarea>';
                // _html += '<a style="margin-top:10px" href="#answerImage'+totalAnswer+'" data-toggle="modal" class="btn btn-sm btn-outline-primary"><i class="fas fa-image"></i>&nbsp; Unggah Gambar</a>';
                _html += '<button type="button" style="margin-top:10px;margin-left:10px" onclick="removeAnswer(\'' + totalAnswer + '\')" class="btn btn-sm btn-outline-danger"><i class="fas fa-x"></i>&nbsp; Hapus Jawaban</a>';
            _html += '</div>';
        _html += '</div>'; // ROW END
        // // FOR MODAL IMAGE //
        // _html += '<div class="modal modal-primary fade" id="answerImage'+totalAnswer+'">';
        //     _html += '<div class="modal-dialog">';
        //         _html += '<div class="modal-content">';
        //             _html += '<div class="modal-header">';
        //                 _html += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
        //                 _html += '<h4 class="modal-title text-inverse">Unggah Gambar (max. 2mb)</h4>';
        //             _html += '</div>';
        //             _html += '<div class="modal-body">';
        //                 _html += '<div class="form-group">';
        //                     _html += '<input type="file" name="option_image'+totalAnswer+'" id="option_image'+totalAnswer+'" class="form-control">';
        //                     _html += '<div id="imagePreview'+totalAnswer+'" class="imagePreview"></div>';
        //                 _html += '</div>';
        //             _html += '</div>';
        //             _html += '<div class="modal-footer">';
        //                 _html += '<button type="button" class="btn btn-outline-primary btn-block" data-dismiss="modal">Simpan!</button>';
        //             _html += '</div>';
        //         _html += '</div>';
        //     _html += '</div>';
        // _html += '</div>';
        // // END MODAL IMAGE //
        // _html += '<br />';
        $("#appendAnswer").append(_html);
        //  // VALIDATION IMAGE //
        // $("#option_image"+totalAnswer).bind("change", function() {
        //     var files = !!this.files ? this.files : [];
        //     if (!files.length || !window.FileReader) {
        //         $("#imagePreview"+totalAnswer).css("background", "transparent");
        //     }; // no file selected, or no FileReader support
        //     if (/^image/.test( files[0].type)){ // only image file
        //         var reader = new FileReader(); // instance of the FileReader
        //         reader.readAsDataURL(files[0]); // read the local file
            
        //         reader.onloadend = function(){ // set image data as background of div
        //         $("#imagePreview"+totalAnswer).css({"background-image" : "url("+this.result+")","background-size" : "cover","background-position" : "center center"});
        //         }
        //     }
        // });
        tinymce.EditorManager.execCommand('mceAddEditor',true, "textareaBlank"+totalAnswer);
        // // END VALIDATION IMAGE //
    }

    function chooseAnswer(count) {
        $.each($(".chooseAnswer"),function(i,v){
            $(this).removeClass('active');
        });
        $("#chooseAnswer"+count).addClass('active');
        $("#choosedAnswer").val(count);
    }

    function removeAnswer(row) {
        var sure = confirm('Anda yakin ingin menghapus jawaban ini ?');
        if (sure) {
            var choosedAnswer = $("#choosedAnswer").val();
            var totalAnswer = $("#totalAnswer").val();
            totalAnswer--;
            $("#totalAnswer").val(totalAnswer);
            if (row === choosedAnswer) {
                chooseAnswer(0);
            };
            $("#rowAnswer"+row).remove();
            // RE-PUSH JSONanswer
            JSONanswer.splice(row,1);
            $("#JSONanswer").val(JSON.stringify(JSONanswer));
            recount();
        };
    }

    function recount() {
        var x = 1;
        $.each($(".forAlph"),function(){
            $(this).text(alphabet(x));
            x++;
        });
    }

    function alphabet(data) {
        var callback = '';
        switch(parseInt(data)) {
            case 1 :
                callback = 'B';
            break;
            case 2 :
                callback = 'C';
            break;
            case 3 :
                callback = 'D';
            break;
            case 4 :
                callback = 'E';
            break;
            case 5 :
                callback = 'F';
            break;
            case 6 :
                callback = 'G';
            break;
            case 7 :
                callback = 'H';
            break;
            case 8 :
                callback = 'I';
            break;
            case 9 :
                callback = 'J';
            break;
            case 10:
                callback = "K";
                break;
            case 11:
                callback = "L";
                break;
            case 12:
                callback = "M";
                break;
            case 13:
                callback = "N";
                break;
            case 14:
                callback = "O";
                break;
            case 15:
                callback = "P";
                break;
            case 16:
                callback = "Q";
                break;
            case 17:
                callback = "R";
                break;
            case 18:
                callback = "S";
                break;
            case 19:
                callback = "T";
                break;
            case 20:
                callback = "U";
                break;
            case 21:
                callback = "V";
                break;
            case 22:
                callback = "W";
                break;
            case 23:
                callback = "X";
                break;
            case 24:
                callback = "Y";
                break;
            case 25:
                callback = "Z";
            break;
            default :
                callback = data;
            break;
        }
        return callback;
    }