<?php
/**
 * Template pour afficher le formulaire de connexion.
 */
?>
<div class="formCreateUser">
    <div class="row p-5">
        <div class="connection-form col-md-4 d-flex flex-column justify-content-center ">
            <form action="index.php?action=createUser" method="post" class="foldedCorner">
                <h2>Inscription</h2>
                <div class="formGrid">
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo</label>
                        <input class="form-control" type="text" name="pseudo" id="pseudo" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input class="form-control" type="text" name="email" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input class="form-control" type="password" name="password" id="password" required>
                    </div>
                    <button class="submit btn btn-primary">Se connecter</button>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <img class="img-fluid" src="https://s3-alpha-sig.figma.com/img/c690/0765/dd6bbafe9a461f128299f90d445728dd?Expires=1711324800&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=FIUnMAXtOYU8SqJzEyV9CA3pHSfvlFvJ7YuIYaRpgXz-r9wUI83lbT3ptnzd82hgGX3bfF7QZS0mfVxs~iCF2hdndNrppxkcZ56Sk70wCT3FzgJNTS5~-j5Uz8W0VhfAbptXfjTEoOI1tmJnUslHcEJpGUZrrv-5H-ri1R18Vbjvbfdfqm5RF31cih9EVPIH9TQcJdprBVjDYSJWaub3hLs35abdVb5kHy8BOCH9LEniGzC~KHXu4jcsjVaTP5sja~jDDa36uRJeP~36jrfNST4UANFtK45Ewh6OkF8B05phqrEPcbPXePBT9htJtB51ylfCed9aXHfc-PNIPb16Eg__" alt="étagère rempli de livre"/>
        </div>
    </div>
</div>