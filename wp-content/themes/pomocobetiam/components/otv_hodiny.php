<?php 
if (is_page('kontakt')): ?>
<table class="otv_hodiny mb-4 mt-4">
<?php 

else: ?>
<table class="otv_hodiny mb-4 ml-4">    
<?php 

endif;

    foreach( OTV_HODINY as $key => $val ): ?>
        
        <tr class="m-0">
            <td class="key pr-4" colspan="2"><?php echo $key; ?>:</td>
            <td class="value"><?php echo $val; ?></td>
        </tr>

    <?php
    endforeach; ?>
</table>