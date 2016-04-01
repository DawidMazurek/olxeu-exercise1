> Stwórz _fork_ repozytorium, a następnie sklonuj projekt. Rozwiązuj zadania zgodnie z ich priorytetem i swoim stylem pracy, korzystając z dowolnych technologii i narzędzi, poświęcając odpowiadającą Tobie ilość czasu. Po zakończeniu pracy prześlij link do swojego repozytorium na adres kbrominski@olx.pl.

# Mikro aplikacja REST
Projekt ten umożliwia zarządzanie słownikiem umiejętności oraz listą swoich umiejętności.

### Uruchomienie
```bash
$ composer install
$ cd web/
$ php -S localhost:8080
$ curl localhost:8080/users/me
{"id":1,"name":"ME"}
```

### Dokumentacja
Zasób | Opis
--- | ---
`/skills` | umiejętności
`/skills/{id}` | umiejętność o ID `{id}`
`/users/me` | użytkownik
`/users/me/skills` | umiejętności użytkownika
`/users/me/skills/{id}` | umiejętność użytkownika o ID `{id}`


### Zadania
1. ~~Wykorzystując zastaną implementację przechowywania umiejętności (`LegacyStorage`), dodaj możliwość dodawania, przeglądania, aktualizowania i usuwania umiejętności _(priorytet=wysoki)_~~
2. Dodaj możliwość dodawania, przeglądania i usuwania relacji umiejętności z użytkownikiem _(priorytet=normalny)_
3. Dodaj zebezpiecznie _Basic access authentication_ do aplikacji _(priorytet=normalny)_
4. ~~Zabezpiecz aplikację przed wyświetlaniem błędów. Zwracaj odpowiednią odpowiedź JSON, ukryj szczegóły błędu, a wyjątek zapisz w dowolnej formie do logu _(priorytet=normalny)_~~ DONE
5. ~~Zaproponuj format dokumentacji API aplikacji _(priorytet=niski)_~~ swagger.io
6. Dodaj możliwość filtrowania umiejętności (`/skills`) po nazwie, np. `?q=programowanie` _(priorytet=normalny)_
7. Przystosuj zasób umiejętności do obsłużenia dużej ilości zapytań GET _(priorytet=wysoki)_
