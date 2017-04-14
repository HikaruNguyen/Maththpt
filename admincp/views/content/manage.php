<script src="../../../public/ckeditor/ckeditor.js" charset="utf-8"></script>

<?php
/**
 * Created by PhpStorm.
 * User: manhi
 * Date: 15/1/2017
 * Time: 11:59 AM
 */

session_start();
if (isset($_SESSION['token'])) {
    include '../../../db/configdb.php';
    require_once('../../../db/DB_ADAPTER.php');
    require_once('../../utils/CRUDUtils.php');
    include '../includes/header.php';
    $delImg = 0;
    $db = new DB_ADAPTER();
    if (isset($_GET['type'])) {
        $type = $_GET['type'];
        $idContent = "";
        $questionContent = "";
        $answerA = "";
        $answerB = "";
        $answerC = "";
        $answerD = "";
        $answerTrue = 0;
        $cateID = 0;
        $testID = 0;
        $imageQuestion = "";
        if ($type == 'edit' || $type == 'delete') {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                var_dump($id);
                $con = array("id" => $id);
                $data = $db->get_by_conditions("tbl_content", $con);
                if (count($data) > 0) {
                    $idContent = $data[0]['id'];
                    $questionContent = $data[0]['question'];
                    $answerA = $data[0]['answerA'];
                    $answerB = $data[0]['answerB'];
                    $answerC = $data[0]['answerC'];
                    $answerD = $data[0]['answerD'];
                    $imageQuestion = $data[0]['image'];
                    $answerTrue = (int)$data[0]['answerTrue'];
                    $cateID = (int)$data[0]['cateID'];
                    $testID = (int)$data[0]['testID'];
                }
            }
        }
        ?>
        <script>
            function getDataCK(action) {
                var question = CKEDITOR.instances.editorQuestion.getData().replace("<p>", "").replace("</p>", "");
                var answer1 = CKEDITOR.instances.editorAnswer1.getData().replace("<p>", "").replace("</p>", "");
                var answer2 = CKEDITOR.instances.editorAnswer2.getData().replace("<p>", "").replace("</p>", "");
                var answer3 = CKEDITOR.instances.editorAnswer3.getData().replace("<p>", "").replace("</p>", "");
                var answer4 = CKEDITOR.instances.editorAnswer4.getData().replace("<p>", "").replace("</p>", "");
                var answerTrue = $("#answer").val();
                var cateID = $("#category").val();
                var testID = $("#test").val();
                var image = null;
                try {
                    image = document.getElementById("thumb").src;
                } catch (err) {
                    image = null;
                }
//                alert(image);
                jQuery.ajax({
                    type: "POST",
                    url: "AjaxCK.php",
                    data: {
                        'action': action,
                        <?php if (isset($id) && $id != null) {
                        echo " \"id\": $id,";
                    }?>
                        "image": image,
                        "question": question,
                        "answerA": answer1,
                        "answerB": answer2,
                        "answerC": answer3,
                        "answerD": answer4,
                        "answerTrue": answerTrue,
                        "cateID": cateID,
                        "testID": testID
                    },
                    success: function (data) {
                        //                        data = true / false;
                        if (data == '1') {
//                            window.location.href = 'index.php';
                            history.go(-1);
                        } else {

                        }
                    }
                });
            }
        </script>
        <form action="" method="post">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-bookmark"></i>
                        <?php
                        if ($type == "add") {
                            echo "Thêm câu hỏi";
                        } else if ($type == "edit") {
                            echo "Sửa câu hỏi";
                        } else if ($type == "delete") {
                            echo "Xóa câu hỏi";
                        }
                        ?>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="alert alert-danger" id="div_error" style="display: none">
                <span>
<!--                    <asp:Label ID="lblError" runat="server" Text="Đã xảy ra lỗi"></asp:Label>-->

                </span>
                    </div>
                    <div class="form-body">
                        <div class="form-group">
                            Mã câu hỏi
                            (*)
                            <input id="txtID" name="txtID" class="form-control" readonly
                                   value="<?php echo $idContent ?>">
                        </div>
                        <div class="form-group">
                            Câu hỏi
                            (*)<br/>
                            <textarea name="editorQuestion" id="editorQuestion" rows="10" cols="80"
                                      title="question"></textarea>
                            <script>
                                CKEDITOR.replace('editorQuestion');
                            </script>
                        </div>
                        <div class="form-group">
                            Ảnh câu hỏi (nếu có)
                            <br/>
                            <label class="control-label">Select File</label>
                            <!--                            <input id="image" name="image" type="file" class="file" multiple-->
                            <!--                                   data-show-upload="false" data-show-caption="true">-->
                            <input id="uploadimg" type="file" onchange="previewFile()" class="file"><br>

                            <img id="thumb" src="<?php echo $imageQuestion ?>" height="200" alt="Image preview..."
                                <?php

                                if (!isset($imageQuestion) || $imageQuestion == null || trim($imageQuestion) == "" || !startsWith($imageQuestion, 'data:image')) {
                                    echo " style=\" display: none; \"";
                                }
                                ?>
                            >
                            <br/>
                            <button id="delImg" type="button" onclick="deleteImage()"
                                <?php
                                if (!isset($imageQuestion) || $imageQuestion == null || trim($imageQuestion) == "") {
                                    echo " style=\" display: none; \"";
                                }
                                ?>
                            >Xóa ảnh
                            </button>
                        </div>
                        <div class="form-group">
                            Đáp án 1
                            (*)<br>
                            <textarea name="editorAnswer1" id="editorAnswer1" rows="10" cols="80"></textarea>
                            <script>
                                CKEDITOR.replace('editorAnswer1');
                            </script>
                        </div>
                        <div class="form-group">
                            Đáp án 2
                            (*)<br>
                            <textarea name="editorAnswer2" id="editorAnswer2" rows="10" cols="80"></textarea>
                            <script>
                                CKEDITOR.replace('editorAnswer2');
                            </script>
                        </div>
                        <div class="form-group">
                            Đáp án 3
                            (*)<br>
                            <textarea name="editorAnswer3" id="editorAnswer3" rows="10" cols="80"></textarea>
                            <script>
                                CKEDITOR.replace('editorAnswer3');
                            </script>
                        </div>
                        <div class="form-group">
                            Đáp án 4
                            (*)<br>
                            <textarea name="editorAnswer4" id="editorAnswer4" rows="10" cols="80"></textarea>
                            <script>
                                CKEDITOR.replace('editorAnswer4');
                            </script>
                        </div>
                        <div class="form-group">
                            Đáp án đúng
                            (*)
                            <select class="form-control" name="answer" id="answer">
                                <option value="1" <?php
                                if ($answerTrue == 1) {
                                    echo "Selected='selected'";
                                }
                                ?>>A
                                </option>
                                <option value="2" <?php
                                if ($answerTrue == 2) {
                                    echo "Selected='selected'";
                                }
                                ?>>B
                                </option>
                                <option value="3" <?php
                                if ($answerTrue == 3) {
                                    echo "Selected='selected'";
                                }
                                ?>>C
                                </option>
                                <option value="4" <?php
                                if ($answerTrue == 4) {
                                    echo "Selected='selected'";
                                }
                                ?>>D
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            Chuyên đề
                            (*)
                            <select class="form-control" name="category" id="category">
                                <?php
                                $dataCate = $db->get_all_record("tbl_category");
                                if (count($dataCate) > 0) {
                                    for ($i = 0; $i < count($dataCate); $i++) {
//                                        $op = "<option value='$dataCate[$i]['id']'";
                                        $op = "<option value='";
                                        $op = $op . $dataCate[$i]['id'];
                                        $op = $op . "' ";
                                        if ($cateID == $dataCate[$i]['id']) {
                                            $op = $op . "selected='selected'";
                                        }
                                        $op = $op . ">" . $dataCate[$i]['name'] . "</option>";
                                        echo $op;
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            Bộ đề
                            (*)
                            <select class="form-control" name="test" id="test">
                                <?php
                                $dataBoDe = $db->get_all_record("tbl_test");
                                if (count($dataBoDe) > 0) {
                                    for ($i = count($dataBoDe) - 1; $i >= 0; $i--) {
//                                        $op = "<option value='$dataCate[$i]['id']'";
                                        $op = "<option value='";
                                        $op = $op . $dataBoDe[$i]['id'];
                                        $op = $op . "' ";
                                        if ($testID == $dataBoDe[$i]['id']) {
                                            $op = $op . "selected='selected'";
                                        }
                                        $op = $op . ">" . $dataBoDe[$i]['displayname'] . "</option>";
                                        echo $op;
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-actions right">
                        <button id="btnCancel" type="button" class="btn default">Hủy</button>
                        <button id="btnOK" type="button" class="btn green" onclick="getDataCK('<?php echo $type; ?>')">
                            <?php
                            if ($type == 'add') {
                                echo "Thêm";
                            } else if ($type == 'edit') {
                                echo "Sửa";
                            } else if ($type == 'delete') {
                                echo "Xóa";
                            }
                            ?>
                        </button>
                    </div>

                </div>
            </div>
        </form>
        <script>
            var question = <?php echo json_encode(str_replace("&nbsp;", " ", str_replace("xmlns=\"http://www.w3.org/1998/Math/MathML\"", "", $questionContent)))?>;
            var answerA = <?php echo json_encode(str_replace("&nbsp;", " ", str_replace("xmlns=\"http://www.w3.org/1998/Math/MathML\"", "", $answerA)))?>;
            var answerB = <?php echo json_encode(str_replace("&nbsp;", " ", str_replace("xmlns=\"http://www.w3.org/1998/Math/MathML\"", "", $answerB)))?>;
            var answerC = <?php echo json_encode(str_replace("&nbsp;", " ", str_replace("xmlns=\"http://www.w3.org/1998/Math/MathML\"", "", $answerC)))?>;
            var answerD = <?php echo json_encode(str_replace("&nbsp;", " ", str_replace("xmlns=\"http://www.w3.org/1998/Math/MathML\"", "", $answerD)))?>;
            CKEDITOR.on('instanceReady', function (evt) {
                if (CKEDITOR.instances.editorQuestion.mode == 'wysiwyg') {
                    CKEDITOR.instances.editorQuestion.setMode('source');
                    CKEDITOR.instances.editorQuestion.setData(question);
//
                } else {
                    CKEDITOR.instances.editorQuestion.setData(question);
                }

                if (CKEDITOR.instances.editorAnswer1.mode == 'wysiwyg') {
                    CKEDITOR.instances.editorAnswer1.setMode('source');
                    CKEDITOR.instances.editorAnswer1.setData(answerA);
//                                        CKEDITOR.instances.editorQuestion.setMode('wysiwyg');
                } else {
                    CKEDITOR.instances.editorAnswer1.setData(answerA);
                }
                if (CKEDITOR.instances.editorAnswer2.mode == 'wysiwyg') {
                    CKEDITOR.instances.editorAnswer2.setMode('source');
                    CKEDITOR.instances.editorAnswer2.setData(answerB);
//                                        CKEDITOR.instances.editorQuestion.setMode('wysiwyg');
                } else {
                    CKEDITOR.instances.editorAnswer2.setData(answerB);
                }
                if (CKEDITOR.instances.editorAnswer3.mode == 'wysiwyg') {
                    CKEDITOR.instances.editorAnswer3.setMode('source');
                    CKEDITOR.instances.editorAnswer3.setData(answerC);
//                                        CKEDITOR.instances.editorQuestion.setMode('wysiwyg');
                } else {
                    CKEDITOR.instances.editorAnswer3.setData(answerC);
                }
                if (CKEDITOR.instances.editorAnswer4.mode == 'wysiwyg') {
                    CKEDITOR.instances.editorAnswer4.setMode('source');
                    CKEDITOR.instances.editorAnswer4.setData(answerD);
//                                        CKEDITOR.instances.editorQuestion.setMode('wysiwyg');
                } else {
                    CKEDITOR.instances.editorAnswer4.setData(answerD);
                }
            })
            ;
        </script>
        <?php

    }
    include '../includes/footer.php';
} else {
    header('location:../../login.php');
}
?>
<script>
    document.getElementById("Menu_Contain").className = "active open";
    function previewFile() {
        var preview = document.getElementById("thumb");
        preview.style.display = "";
        document.getElementById("delImg").style.display = "";
        var file = document.getElementById("uploadimg").files[0];
        var reader = new FileReader();

        reader.addEventListener("load", function () {
            preview.src = reader.result;
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }
    function deleteImage() {
        document.getElementById('thumb').removeAttribute("src");
        document.getElementById('thumb').style.display = "none";
        document.getElementById('delImg').style.display = "none";
    }
</script>
<?php
if (!empty($_POST)) {
    var_dump($type . " " . $_POST['editorQuestion'] . " " . $_POST['editorQuestion']);
    ob_start();
    /*if ($type != null && trim($type) != "") {
        if ((isset($_POST['txtID']) || $type == 'add')
            && isset($_POST['editorQuestion']) && isset($_POST['editorAnswer1'])
            && isset($_POST['editorAnswer2']) && isset($_POST['editorAnswer3'])
            && isset($_POST['editorAnswer3']) && isset($_POST['editorAnswer4']) && ($_POST['answer'])
        ) {

            if ((($_POST['txtID'] != null && trim($_POST['txtID']) != "") || $type == 'add') && $_POST['txtName'] != null && trim($_POST['txtName']) != ""
                && $_POST['txtAuthor'] != null && trim($_POST['txtAuthor'])
            ) {
                $result = 0;
                $result = CRUDUtils::manageBoDe($type, $_POST['txtID'], $_POST['txtName'], $_POST['txtAuthor']);
    //            var_dump("result " . $result);
                if ($result == 1) {
                    header('location:../test');
                }
            }
        }

    }*/
    ob_end_flush();
}
function startsWith($haystack, $needle)
{
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

?>

