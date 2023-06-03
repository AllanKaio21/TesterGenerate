%{
#include "parser.tab.h"
char *stringpool(char *);
int debug = 0; 
%}
%option yylineno

ID [0-9a-zA-Z_//:<?>\\;()$]*
NUM [0-9]+"."*[0-9]*
DATY "/*Y:"[A-Za-z0-9_\-\.@\\/ ]*"*/"
DATN "/*N:"[A-Za-z0-9_\-\.@\\/ ]*"*/"
CB "/**"[A-Za-z0-9_ \n\t\/@$*"{}$.,]*"*/"
CS "//"[A-Za-z0-9_ \n@$*{}$.,]*
%%

"<?php"     { if(debug) printf("PHP \n"); return (PHP); }
"{"         { if(debug) printf("KEY OPEN\n"); return (KEYOPEN); }
"}"         { if(debug) printf("KEY CLOSE\n"); return (KEYCLOSE); }
"rules"     { if(debug) printf("RULE\n"); return (FUNC); }
"class"     { if(debug) printf("CLASS\n"); return (CLASS); }
"return"    { if(debug) printf("RETURN\n"); return (RETURN); }
"["         { if(debug) printf("BRACKET OPEN\n"); return (BRACKETOPEN); }
"]"         { if(debug) printf("BRACKET CLOSE\n"); return (BRACKETCLOSE); }
","         { if(debug) printf("COMMA\n"); return (COMMA); }
"'"         { if(debug) printf("APOSTRAFO\n"); return (APOS); }
"=>"        { if(debug) printf("ASSING\n"); return (ASSING); }
{NUM}       { if(debug) printf("ASSING\n"); return (CONST); }
{ID}+       { if(debug) printf("ID\n"); yylval.xstr = stringpool(yytext); return (IDENTIFIER); }
{DATY}      { if(debug) printf("DATA YES\n"); yylval.xstr = stringpool(yytext); return (DATAY); }
{DATN}      { if(debug) printf("DATA NO\n"); yylval.xstr = stringpool(yytext); return (DATAN); }
"\n"        { if(debug) printf("\n"); /*incrementa sozinho lineno*/ }
{CB}        { if(debug) printf("Comentário de bloco\n"); }
{CS}        { if(debug) printf("Comentário simples\n"); }
[ \t]+ /* blank, tab, new line: eat up whitespace */
.           {  return(yytext[0]); }

%%