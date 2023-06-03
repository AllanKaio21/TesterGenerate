%{
#include <stdio.h>
#include <ctype.h>
#include "sym.h"
#include <string.h>
#include "helpers.c"

#define add(n) SymTab = MakeVAR(n,SymTab)
#define addData(n,cd,id) AddData(n,cd,id)
#define addRule(r) AddRule(r)

extern int yylineno;
extern VAR *SymTab;

char *class;
char field[100];

int err = 1;

%}
%define parse.error verbose
%union {
    char * xstr;
	}
%start program
%token BRACKETOPEN BRACKETCLOSE COMMA APOS ASSING CONST KEYOPEN KEYCLOSE FUNC RETURN PHP
%token <xstr> IDENTIFIER
%token <xstr> DATAY
%token <xstr> DATAN
%token <xstr> CLASS

%%

program: header function RETURN BRACKETOPEN listas BRACKETCLOSE end
    ;

header: PHP IDENTIFIER
    | header IDENTIFIER
    ;

function: CLASS IDENTIFIER {class = $2;}
    | FUNC KEYOPEN
    | function KEYOPEN
    | function IDENTIFIER
    ;

listas: lista
    | lista COMMA
    | lista COMMA listas
    ;

lista: BRACKETOPEN atributos rules BRACKETCLOSE
    ;

atributos: APOS IDENTIFIER {add($2); strcpy(field, $2);} APOS data
    | BRACKETOPEN atributo BRACKETCLOSE
    ;

atributo: APOS IDENTIFIER {add($2); strcpy(field, $2);} APOS data
    | atributo COMMA APOS IDENTIFIER {add($4); strcpy(field, $4);} APOS data
    ;

data: /* Empty */ {addData(field, NULL, NULL);}
    | data DATAN {addData(field, NULL, $2);}
    | data DATAY {addData(field, $2, NULL);}
    ;

rules: rule
    | rules rule
    | rules ASSING assignment
    ;

rule: COMMA IDENTIFIER {addRule($2);}
    | COMMA APOS IDENTIFIER APOS {addRule($3);}
    ;

assignment: CONST
    | IDENTIFIER
    | APOS IDENTIFIER APOS
    | APOS CONST APOS
    | BRACKETOPEN assignment ASSING assignment BRACKETCLOSE
    ;

end: IDENTIFIER KEYCLOSE ignor
    | KEYCLOSE ignor
    ;

ignor: {while (yylex() != 0){/* Vazio */}}
     ;

%%

main( int argc, char *argv[] )
{
    init_stringpool(10000);
    if ( yyparse () == 0 && err ) {
        // Configuration
        char correct[255], incorrect[255], tdelete[255], folder[255], *dir;

        sprintf(folder, "tests");
        mkdir(folder);
        sprintf(folder, "%s/%s", folder, class);
        mkdir(folder);
        sprintf(correct, "%s/Test%sCorrectFields.php", folder, class);
        sprintf(incorrect, "%s/Test%sIncorrectFields.php", folder, class);
        sprintf(tdelete, "%s/Test%sDelete.php", folder, class);

        /* Função de geração dos testes */
        generateTests(correct, incorrect, tdelete, class);

        printf("\nCodigo sem erros!\n");  
    }
}

yyerror (char *s)
{
    printf("\033[0;31m%s na linha \033[0;37m%d\033[0;37m\n", s, yylineno);
    err = 0;
}




