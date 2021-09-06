<footer class="main-footer">
	<div class="pull-right hidden-xs">
		<b>Versão</b> 1.0.0
	</div>
	<strong>Copyright &copy; <?php echo date("Y"); ?> DAVI-SM.</strong> Todos os direitos reservados.
</footer>
<input type="hidden" id="baseurl" name="baseurl" value="{{ env('APP_URL') }}" />

@yield('js')

</body>

</html>