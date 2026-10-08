# Metodo di sviluppo con AI

Il sito è sviluppato con l'assistenza dell'AI seguendo un processo definito, non per tentativi.

## Il ciclo di lavoro

1. **Specifica prima del codice:** ogni compito parte da questa documentazione (regole d'oro, ontologia, token).
2. **Un compito piccolo alla volta:** un componente o una pagina per sessione.
3. **Verifica:** `npm run check` senza errori, controllo su desktop e mobile, Lighthouse e axe.
4. **Comprensione:** ogni modifica viene letta e capita prima di essere accettata.
5. **Salvataggio con Git:** commit piccoli e descrittivi.

## Git

- Si lavora su un **branch per funzionalità**, mai direttamente su `main`.
- Il merge in `main` avviene dopo la verifica.

## Revisione

Ogni componente finito viene rivisto prima di essere considerato chiuso: si controlla che rispetti le regole d'oro di `AGENTS.md`, che usi solo i token e che funzioni su desktop e mobile. Se possibile, una revisione esterna della struttura (per esempio da Jérémy) a metà ottobre.
