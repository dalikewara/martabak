<?php $footerLangs = isset($setLangs) ? $setLangs : (isset($langs) ? $langs : FALSE);$footerIndexLang = isset($indexLang) ? $indexLang : FALSE;?>
<div style="margin:60px 0 20px">
<div class="L-t-a-center">
<span class="L-g-f-lato L-font-12px L-c-blacksmooth"><?= $footerLangs->indications()['footer']['tagline'][$footerIndexLang] ?></span>
</div>
</div>
