<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>A Simple Page with CKEditor</title><!-- Make sure the path to CKEditor is correct. -->
    <script src="public/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="public/ckeditor/ckeditor.js" charset="utf-8"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
</head>
<body>
<form>
    <textarea name="editor1" id="editor1" rows="10" cols="80"></textarea>
    <script>
        CKEDITOR.replace('editor1');
        //        var imgHtml = CKEDITOR.dom.element.createFromHtml("<b>AAA</b>");
        CKEDITOR.on('instanceReady', function (evt) {
            // your stuff here
            if (CKEDITOR.instances.editor1.mode == 'wysiwyg') {
//                alert("wysiwyg");
                CKEDITOR.instances.editor1.setMode('source');
                var value1 = "Khoảng cách lớn nhất giữa 2 điểm cực trị của đồ thị hàm số <math><mi>y</mi><mo>=</mo><msup><mi>x</mi><mn>3</mn></msup><mo>+</mo><mn>3</mn><mi>x</mi><mo>-</mo><mn>4</mn></math> là";
                var count = 0;
                CKEDITOR.instances.editor1.setData(value1);
//                CKEDITOR.instances.editor1.setMode('wysiwyg');
            } else {
//                editor.setMode('wysiwyg', function() {
//                    editor.insertHtml(value);
//                    editor.setMode('source');
//                });
                var value1 = "Khoảng cách lớn nhất giữa 2 điểm cực trị của đồ thị hàm số <math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mi>y</mi><mo>=</mo><msup><mi>x</mi><mn>3</mn></msup><mo>+</mo><mn>3</mn><mi>x</mi><mo>-</mo><mn>4</mn></math> là";

                CKEDITOR.instances.editor1.setData(value1);
//                alert("Source");
            }
        });
    </script>
    Mathml
    <textarea name="resultLatext" id="resultLatext" rows="10" cols="80"
              style="margin-top: 10px; width: 100%"></textarea>
    <button id="btnConvert" onclick="myConvert()" type="button">Chuyển đổi</button>
    <button id="btnCheck" onclick="CheckEditor()" type="button">Fake Data</button>
    <script>
        function myConvert() {
            document.getElementById("resultLatext").value = CKEDITOR.instances.editor1.getData().replace("<p>", "").replace("</p>", "");
        }

        function CheckEditor() {
            var value1 = "Khoảng cách lớn nhất giữa 2 điểm cực trị của đồ thị hàm số <math xmlns=\"http://www.w3.org/1998/Math/MathML\"><mi>y</mi><mo>=</mo><msup><mi>x</mi><mn>3</mn></msup><mo>+</mo><mn>3</mn><mi>x</mi><mo>-</mo><mn>4</mn></math> là";

            if (CKEDITOR.instances.editor1.mode == 'wysiwyg') {
//                alert("wysiwyg");
                CKEDITOR.instances.editor1.setMode('source');
                CKEDITOR.instances.editor1.setData(value1);
                CKEDITOR.instances.editor1.setMode('wysiwyg');
            } else {
//                editor.setMode('wysiwyg', function() {
//                    editor.insertHtml(value);
//                    editor.setMode('source');
//                });
                var value1 = "<math xmlns='http://www.w3.org/1998/Math/MathML'><mfrac><mn>1</mn><mn>2</mn></mfrac></math>";
                CKEDITOR.instances.editor1.setData(value1);
//                alert("Source");
            }
        }
    </script>

</form>
</body>
</html>