<div class="col-sm-4 col-md-4">
  <input type="submit" id="validar" value="Validar codigo">
  <input type="text" name="codigo" id="codigo">
  <div id="inner"></div>
</div>
<script>
  validar.addEventListener("click", (e) => {
    e.preventDefault();
    codigos();
  });

  function codigos() {
    const datos = document.getElementById("codigo").value;
    // console.log(datos);
    fetch("codigos.php", {
      method: "POST",
      body: datos
    }).then(response => response.json()).then(response => {
      // tbautos.innerHTML = response;
      const datos = document.getElementById("codigo").value = "";
      inner.innerHTML = `
                <p> Ciudad: ${response.Ciudad}</p>
                <p> Colonia: ${response.Colonia}</p>
                `;
    });
  }
</script>