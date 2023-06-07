# API_NBP_CON
 
Zadanie rekrutacyjne.
Proszę o wykonanie zadania wg. instrukcji:
1. Założenie prywatnego repozytorium kodu na github 
2. Uruchomienie czystej instancji aplikacji z wybranym frameworkiem + commit z git init.
3. Wygenerowanie encji Currency z polami (wielkości pól w bazie proszę pobrać na 
podstawie własnych preferencji/doświadczeń):
- id - uuid
- name - string - nazwa waluty
- currency_code - string -
- exchange_rate - proszę dobrać typ wg. własnych doświadczeń - wartość kursu waluty 
względem złotówki (czyli np. dla EURO będzie to np. 1 Euro = 4,75 PLN, czyli chcemy w 
bazie mieć wartość 4,75 lub np. 475 (w zależności od podejścia))
4. Przygotowanie integracji z API NBP - http://api.nbp.pl/
a) integracja powinna połączyć się z API NBP i pobrać dane o aktualnych kursach walut (z 
tabeli A)
b) jeżeli dana waluta już istnieje, to powinna zostać zaktualizowana wartość exchange_rate
c) jeżeli dana waluta nie istnieje, powinna zostać dodana