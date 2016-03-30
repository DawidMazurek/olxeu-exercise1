>> Stwórz _fork_ repozytorium, a następnie sklonuj projekt. Rozwiązuj zadania/problemy zgodnie ze swoim stylem pracy, korzystając z dowolnych technologii i narzędzi, poświęcając odpowiadającą Tobie ilość czasu. Po zakończeniu pracy prześlij link do swojego repozytorium na adres kbrominski@olx.pl.

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
1. Wykorzystując zastaną implementację przechowywania umiejętności, dodaj możliwość dodawania, przeglądania, aktualizowania i usuwania umiejętności (priorytet=wysoki, deadline=krótki)
2. Dodaj możliwość dodawania, przeglądania i usuwania relacji umiejętności z użytkownikiem (priorytet=normalny, deadline=normalny)
3. Dodaj zebezpiecznie Basic Auth do aplikacji (priorytet=normalny, deadline=długi)
4. Zabezpiecz aplikację przed wyświetlaniem błędów. Zwracaj odpowiednią odpowiedź JSON, ukryj szczegóły błędu, a wyjątek zapisz w dowolnej formie do logu (priorytet=normalny, deadline=normalny)
5. Zaproponuj format dokumentacji API aplikacji (priorytet=niski, deadline=długi)
6. Dodaj możliwość filtrowania umiejętności (`/skills`) po nazwie (priorytet=normalny, deadline=krótki)
7. Przystosuj zasób umiejętności do obsłużenia dużej ilości zapytań GET (priorytet=wysoki, deadline=normalny)