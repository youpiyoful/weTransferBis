Bonjour les coupaingues !

Alors pour installer sass sous linux, voici la démarche à suivre, n'hesiez pas à me dire si j'ai mal expliqué un truc.


Tout d'abord on prépare le terrain :

-1 : Créer dans le dossier assets un dossier css et un dossier scss
-2 : Dans le dossier scss, créer un fichier "style.scss"


Une fois choses faites, rendez vous dans votre terminal IDE et taper les lignes suivantes :


sudo apt install ruby-sass


Cette ligne vas vous installer ruby & sass.

Si vous voulez, vous pouvez check si sass c'est bien installé à jour "sass --version"


Maintenant, pour créer et lier vos fichier scss & css, tapez cette dernière commande :

sass --watch assets/scss/style.scss:assets/css/style.css


Et voalà, normalement dans votre css vous devriez avoir un fichier style.css et un fichier style.css.map !