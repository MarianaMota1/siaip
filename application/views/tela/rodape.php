</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ"
        crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="<?= base_url('assets/js/vendor/jquery.min.js') ?>"><\/script>')</script>
<script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/vendor/holder.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/ie10-viewport-bug-workaround.js'); ?>"></script>
<script>
    <?php if ($this->session->userdata('usuario') != null) { ?>
    function logout() {
        if (confirm('TEM CERTEZA QUE DESEJA SAIR?')) {
            location.href = "<?= base_url('usuario/sair') ?>"
        }
    }

    function apagar(url) {
		if(confirm("TEM CERTEZA QUE DESEJA APAGAR?")){
			location.href = url;
		}
    }
    <?php } ?>
</script>
</body>
</html>
