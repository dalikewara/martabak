<style media="screen">
    #toolkit-parent {
        width: 100%;
        box-sizing: border-box;
        margin: 2px 0;
    }
    #toolkit-child {
        padding: 2px 15px;
    }
    .toolkit-section, .toolkit-section-inner {
        display: inline-block;
    }
</style>
<div id="toolkit-parent" class="L-box-1">
    <div id="toolkit-child" class="">
        <div class="toolkit-section">
            <div class="toolkit-section-inner">
                <span>Insert layout: </span>
            </div>
            <div class="toolkit-section-inner">
                <select id="toolkit-layout-item" class="" name="layout-item" url="<?php echo $uri->toolkit_layout; ?>">
                </select>
                <select id="toolkit-layout-model" class="" name="layout-model">
                    <option value="trough"> Through
                    <option value="dinamic"> Dinamic
                </select>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    Petis('#toolkit-layout-item').load(Petis('#toolkit-layout-item').attr('url'));
    // Insert layout to code editor
    Petis('#toolkit-layout-item').on('change', function()
    {
        if(Petis('#toolkit-layout-model').val === 'trough')
        {
            editor.setValue(editor.getValue() + Petis(this).val);
        }
        else
        {
            editor.setValue(editor.getValue() + 'This is dinamic');
        }
    });
</script>
