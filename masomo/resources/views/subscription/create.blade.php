

<?php 

$datastring =  $fields['live'].$fields['oid'].$fields['inv'].$fields['ttl'].$fields['tel'].$fields['eml'].$fields['vid'].$fields['curr'].$fields['p1'].$fields['p2'].$fields['p3'].$fields['p4'].$fields['cbk'].$fields['cst'].$fields['crl'];
$hashkey ="demo";//use "demo" for testing where vid also is set to "demo"

/********************************************************************************************************
* Generating the HashString sample
*/
$generated_hash = hash_hmac('sha1',$datastring , $hashkey);

?>
<!--    Generate the form BELOW   -->
<form method="post" action="https://payments.ipayafrica.com/v3/ke" id="ipayCheckout">

<?php 
 foreach ($fields as $key => $value) {
      echo $key;
     echo '&nbsp;:<input name="'.$key.'" type="text" value="'.$value.'" class="form-control"></br>';
 }
?>hsh:&nbsp;<input name="hsh" type="text" value="<?php echo $generated_hash ?>" ></td>

<button type="submit">&nbsp;Lipa&nbsp;</button>
</form>

<script>
    document.getElementById("ipayCheckout").submit();
</script>
 