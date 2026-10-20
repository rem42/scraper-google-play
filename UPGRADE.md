# Mise à jour vers la prochaine majeure

Aucune classe ni signature publique n'a changé : les `Request`, `Api` et modèles gardent leurs noms et leur comportement.

Ruptures :

- PHP `^8.4` est requis (au lieu de `^8.1`).
- `rem42/scraper` `^3.4` est requis (au lieu de `^3.0`).
- `symfony/serializer-pack` et `symfony/http-client` ne sont plus déclarés directement : le cœur les apporte.

Les ruptures de dépendances justifient une nouvelle version majeure.
