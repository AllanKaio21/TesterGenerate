#! /bin/bash
echo -e "Escreva o nome do arquivo de entrada"
echo -n "=> "
read resp
if flex scanner.l; then
    if bison -vd parser.y; then
        if gcc lex.yy.c parser.tab.c sym.c -o compiler -lfl; then
            ./compiler < $resp
        fi
    fi
fi