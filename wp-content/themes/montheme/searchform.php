<!-- echo esc_url qui permet de récupérer l'url des pages -->
<form class="form-inline my-2 my-lg-0" action="<?= esc_url(home_url()) ?>">
    <!-- get_search_query() permet de récupérer ce qui a été demandé par l'utilisateur -->
    <input class="form-control mr-sm-2" name="s" type="search" placeholder="Recherche" aria-label="Search" value="<?= get_search_query() ?>">
    <button class="btn btn-light  my-2 my-sm-0" type="submit">Rechercher</button>
</form>