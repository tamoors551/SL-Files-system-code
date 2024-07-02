<!-- PhP Files Systems -->
<!--it check that the files is Exist or not  -->
<!-- 
    
    <?php 

$file="readme.txt";
if(file_exists($file)){
    echo "The file exists";
}else{
    echo "The file does not exist";
}

// echo file_get_contents($file);

// $file_content=file_get_contents($file);
// echo $file_content;

// $file_content=file_get_contents($file);
// echo $file_content;

// $file_content=file_get_contents($file);
// echo $file_content;

// $file_content=file_get_contents($file);
// echo $file_content;

?>

<br>
<?php
// copy function 
// it is used for the copy a files 

$file="readme.txt";
if(file_exists($file)){
    echo "The file exists";
    copy($file, "readme1.txt");
    echo "The file is copied";

}else{
    echo "The file does not exist";
}


?>


<!-- Rename the files -->

<?php
//rename function 
// it is used for the copy a files 

$file="readme.txt";
if(file_exists($file)){
    echo "The file exists";
    rename($file, "tamoor.txt");
    echo "The file is copied";

}else{
    echo "The file is rename ";
}


?>


<!-- Clone the files -->
<?php
//Clone a files ll
// it is used for the copy a files 

$file="readme.txt";
if(file_exists($file)){
    echo "The file exists";
    copy($file, "readme1.txt");
    echo "The file is copiedff";

}else{
    echo "The file does not exist";
}


?>

<!-- Delete or remove a files -->

<?php

$file="readme1.txt";
if(file_exists($file)){
   unlink("tamoor.txt");

}
else

{
    echo "The file was removed";
}
?>


<!-- Creat a Folder -->
<?php

$file="readme1.txt";

mkdir("tamoor");

?>
<?php

$file="readme1.txt";

mkdir("basil");

?>

<?php

$file="readme1.txt";

if(!file_exists("huda")){
    mkdir("huda");
}
else{
    echo "Folder already Exist";
}

?>

<!-- file size in bites  -->
<?php

$file="readme1.txt";

echo filesize($file);

?>

<!-- file type in bites  -->
<?php

$file="readme1.txt";

echo filetype($file);

?>

<hr>
<!-- Folder type  -->
<h2>file-type or Folder-Type </h2>
<?php

$file="readme1.txt";

echo filetype("basil");

?>

<hr>
<!-- Folder type  -->
<h2>Path of the file or Folder </h2>
<?php

$file="readme1.txt";

echo realpath("basil");

?>
<!-- ================================================================= -->
<hr>
<!-- Folder type  -->
<h2>file-type or Folder-Type </h2>
<?php

$file="readme1.txt";

print_r(pathinfo($file));
// Array ( [dirname] => . [basename] => readme1.txt [extension] => txt [filename] => readme1 )/
?>

<!-- ================================================================= -->
<hr>
<!-- Folder type  -->
<h2>path of the files or folder </h2>
<?php

$file="readme1.txt";

$path="readme1.txt";
echo "<pre>";
print_r(pathinfo($file));
echo "</pre>";

?>
<!-- ================================================================= -->
<hr>
<!-- Folder type  -->
<h2>BASE-NAME </h2>
<?php

$file="readme1.txt";

$path= realpath($file);
echo "<pre>";
print_r(pathinfo($file,PATHINFO_BASENAME));
echo "</pre>";

?>
<!-- ================================================================= -->
<hr>
<!-- Folder type  -->
<h2>file name  </h2>
<?php

$file="readme1.txt";

$path= realpath($file);
echo "<pre>";
print_r(pathinfo($file,PATHINFO_FILENAME));
echo "</pre>";

?>
<!-- ================================================================= -->
<hr>
<!-- Folder type  -->
<h2>basename -use ? </h2>
<?php

$file="readme1.txt";

$path= realpath($file);
echo basename($file ,".txt");

?>

<!-- ================================================================= -->
<hr>
<!-- Folder type  -->
<h2>use </h2>
<?php

$file="readme1.txt";

$path= realpath($file);
echo dirname($file,2) ;

?>

<!--  -->

<?php
// readfile()
// file_exists()
// copy()
// rename()
// mkdir()
// rmdir()
// delete()
// unlink()
// filesize()
// filetype()
// pathinfo()
// realpath()
// basename()
// dirname()
// basename()



?>


<?php

// fopen()
// fread()
// fget()
// ftell()
// fseek()
// fpassthru()
// rewind()
// feof()
// file()
// fgetc()
// fwrite()
// fputs()
// fclose()
// ftruncate()
?>

<!-- ================================================================= -->
<hr>
<!-- Open a file in read mode -->
<h2>Open a file in read mode </h2>

<?php
// fopen(" [file-name]readme.txt","r []");0
$file = fopen("readme1.txt","r");

echo fread($file, 300);

?>

<!-- ================================================================= -->
<hr>
<!-- Open a file in read mode -->
<h2>Open a file in read mode </h2>

<?php
// fopen(" [file-name]readme.txt","r []");0
$file = fopen("readme1.txt","r");

echo fread($file, filesize("readme1.txt"));

?>







