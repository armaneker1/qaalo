 <?php
$allowedExts = array("jpg", "jpeg", "gif", "png");
$extension = end(explode(".", $_FILES["file"]["name"][0]));

if ((($_FILES["file"]["type"][0] == "image/gif")
|| ($_FILES["file"]["type"][0] == "image/jpeg")
|| ($_FILES["file"]["type"][0] == "image/png")
|| ($_FILES["file"]["type"][0] == "image/pjpeg"))
&& ($_FILES["file"]["size"][0] < 200000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"][0] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"][0] . "<br>";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"][0] . "<br>";
    echo "Type: " . $_FILES["file"]["type"][0] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"][0] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"][0] . "<br>";

    if (file_exists($_FILES["file"]["name"][0]))
      {
      echo $_FILES["file"]["name"][0] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"][0],$_FILES["file"]["name"][0]);
      echo "Stored in: " . "upload/" . $_FILES["file"]["name"][0];
      }
    }
  }
else
  {
  echo "invalidd file";
  }
?>