<style media="screen">
    #notice {
        position: fixed;
        top: 40px;
        width: 100%;
        height: 40px;
        display: none;
        visibility: hidden;
    }
    #notice-message {
        display: none;
        visibility: hidden;
    }
</style>
<div id="notice" class="L-notice-2-danger">
    <div id="notice-inner">
        <span id="notice-text"></span>
        <span id="notice-message">Click to hide this notice.</span>
    </div>
</div>
<script type="text/javascript">
    Petis('#notice').on('mouseenter', function()
    {
        Petis('#notice-message').show();
        Petis('#notice-text').hide();
    });
    Petis('#notice').on('mouseleave', function()
    {
        Petis('#notice-message').hide();
        Petis('#notice-text').show();
    });
    Petis('#notice').on('click', function()
    {
        Petis(this).hide();
        Petis('#notice').attr('class', 'L-notice-2-danger');
    });
</script>
