# Documentació Pràctica 03

## Funcions

### `inserir()`
Aquesta funció s'encarrega d'inserir un nou article a la base de dades.

- **Passos**:
  1. Requereix la connexió a la base de dades (`connexio.php`).
  2. Recull les dades enviades pel formulari (`titol`, `cos`).
  3. Escapa caràcters per evitar **code injection** (`htmlspecialchars`).
  4. Valida que el títol i el cos no estiguin buits.
  5. Si tot és correcte, insereix les dades a la base de dades i redirigeix l'usuari.
  6. En cas d'errors, es mostren missatges d'error personalitzats.

### `modificar()`
Aquesta funció actualitza un article existent a la base de dades.

- **Passos**:
  1. Requereix la connexió a la base de dades (`connexio.php`).
  2. Recull les dades del formulari (`id`, `titol`, `cos`).
  3. Escapa caràcters per evitar **code injection**.
  4. Valida que l'ID, el títol i el cos no estiguin buits.
  5. Si tot és correcte, comprova si l'ID existeix a la base de dades i actualitza l'article.
  6. Si l'ID no existeix o hi ha errors, es mostren missatges d'error.

### `eliminar()`
Aquesta funció elimina un article de la base de dades.

- **Passos**:
  1. Requereix la connexió a la base de dades (`connexio.php`).
  2. Recull l'ID de l'article a eliminar.
  3. Escapa caràcters per evitar **code injection**.
  4. Comprova si l'ID no està buit i existeix a la base de dades.
  5. Si tot és correcte, elimina l'article de la base de dades.
  6. En cas d'errors, es mostren missatges d'error.

### `consultar()`
Aquesta funció consulta un article específic a la base de dades basant-se en el seu ID.

- **Passos**:
  1. Requereix la connexió a la base de dades (`connexio.php`).
  2. Recull l'ID introduït per l'usuari.
  3. Escapa caràcters per evitar **code injection**.
  4. Comprova si l'ID està buit o no existeix a la base de dades.
  5. Si tot és correcte, recupera les dades de l'article i les mostra en format de taula.

### `mostrar()`
Aquesta funció mostra tots els articles de la base de dades amb paginació.

- **Passos**:
  1. Requereix la connexió a la base de dades (`connexio.php`).
  2. Defineix quants articles es mostraran per pàgina.
  3. Calcula el número de pàgines necessàries segons el total d'articles.
  4. Genera una taula HTML amb els articles.
  5. Inclou controls de paginació per navegar entre pàgines.

### `tractarErrors($errors)`
Aquesta funció tracta i genera missatges d'error en funció dels errors detectats.

- **Paràmetres**:
  - `$errors`: Array que conté els missatges d'error a mostrar.
  
- **Retorn**:
  - Retorna un missatge HTML que inclou tots els errors.

### `mostrarMissatge($crud, $missatge)`
Aquesta funció gestiona els missatges generats per les diferents operacions (CRUD) i els passa a la vista corresponent.

- **Paràmetres**:
  - `$crud`: Determina quin tipus d'operació s'ha realitzat (`consultar`, `inserir`, `modificar`, `eliminar`).
  - `$missatge`: El missatge a mostrar a la vista.

## Control de Flux

- **Inserir**: Si es fa clic al botó "inserir", es crida la funció `inserir()` i es redirigeix a la vista corresponent.
- **Modificar**: Si es fa clic al botó "modificar", es crida la funció `modificar()` i es redirigeix a la vista corresponent.
- **Eliminar**: Si es fa clic al botó "eliminar", es crida la funció `eliminar()` i es redirigeix a la vista corresponent.
- **Consultar**: Si es fa clic al botó "consultar", es crida la funció `consultar()` i es redirigeix a la vista corresponent.
- **Mostrar**: Si la sessió conté la variable `mostrar`, es crida la funció `mostrar()`.
