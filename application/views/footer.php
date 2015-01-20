</div><!-- /.container -->
<div class="footer">
    <div class="container">
        <p class="text-muted">&copy; 2014 <span>Reputation</span>, Inc.</p>
    </div>
</div>
<!-- script references -->
<?php include_once 'includes.php' ?>
<?php if (!empty($jsfile)) { ?>
    <script src="<?= base_url() ?>public/js/<?= $jsfile ?>.js"></script>
<?php } ?>
</body>
</html>