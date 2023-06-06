#include <stdio.h>
#include <stdlib.h>
#include <ctype.h>
#include <string.h>
#include "sym.h"

char *TestClass, rout[100];

/* Concatena dois arquivos */
void cat(FILE * base, FILE * copy)
{
    int i = 1;
    char Linha[100];
    char *result;
    while (!feof(copy))
    {
        result = fgets(Linha, 100, copy);
        if (result)
            fprintf(base, "%s", Linha);
        i++;
    }
}

/* Escreve uma string no arquivo */
void write(FILE *file, char *s)
{
    fprintf(file, "%s", s);
}

/* Cria a string de routa da classe */
void toRout(char *s)
{
    int i = 0;
    while (i < strlen(s))
    {
        rout[i] = tolower(s[i]);
        i++;
    }
}

/* Cria a classe de teste php */
void classPhp(FILE *file, char *class, int type)
{
    if (type == 3)
        fprintf(file, "<?php\nclass Test%sDeleteCest\n{\n", class);
    else if (type == 2)
        fprintf(file, "<?php\nclass Test%sIncorrectFieldsCest\n{\n", class);
    else if (type == 1)
        fprintf(file, "<?php\nclass Test%sCorrectFieldsCest\n{\n", class);
}

/* Fnção para printar dados */
void printa()
{
    VAR *p = SymTabState();
    while ((p != NULL))
    {
        printf("Name: %s -> Rule: %s cData: [", p->name, p->rule);
        int i = 0;
        while (i < p->cD)
        {
            printf("%s, ", p->cData[i]);
            i++;
        }
        printf("]  iData: [", p->cData[i]);
        i = 0;
        while (i < p->iD)
        {
            printf("%s, ", p->iData[i]);
            i++;
        }
        printf("]\n");
        p = p->next;
    }
}

/* Comparar strings de ponteiros */
int compare(char *str1, char *str2)
{
    while (*str1 == *str2)
    {
        if (*str1 == '\0' && *str2 == '\0')
            return 1;
        str1++;
        str2++;
    }

    return 0;
}

/* Remove a parte de comentarios dos lados de um dado
 * Ex.: Entrada: /*Allan*/
/* Saida: Allan
 */
char *removeCM(char *str)
{
    char data[256];
    memset(data, 0, sizeof(data));
    int n = 0, i = 4;
    while (i < strlen(str) - 1)
    {
        if (!(str[i] == '*' && str[i + 1] == '/'))
            data[n++] = str[i];
        i++;
    }
    char *r = data;
    r[n] = '\0';

    return r;
}

/* Criar teste de delete*/
void deleteTest(FILE *file, char *class) {
    VAR *p = SymTabState();
    VAR *p2 = SymTabState();
    int n = 0, flag = 1;
    while (p != NULL) {
        if(p->cData[0] != NULL){
            int i = 0;
            while(i < p->cD) {
                if(i != 0 || flag){
                    fprintf(file, "\t// XXX: Field deletion test %s with data in %d° position. { %s }\n", p->name, i+1, p->cData[i]);
                    fprintf(file, "\tpublic function %sDelete%c%sIn%c%sData%d(FunctionalTester $I)\n\t{\n", class, toupper(p->name[0]), &p->name[1], toupper(p->rule[0]), &p->rule[1], n+1);
                    fprintf(file, "\t\t$I->wantTo('Verify exception for delete');\n");
                    fprintf(file, "\t\t$model = $I->grabRecord('app\\models\\%s', array('%s' => '%s'));\n", TestClass, p->name, removeCM(p->cData[i]));
                    fprintf(file, "\t\t// TODO: Change the attribute name 'id' to the first key of the table if necessary.\n");
                    fprintf(file, "\t\t$id = $model->id;\n");
                    fprintf(file, "\t\t$I->amOnRoute('/%s/delete', ['id' => $id]);\n", rout);
                    fprintf(file, "\t\t$I->dontSeeRecord('app\\models\\%s', ['id' => $id]);\n\t}\n\n", class);
                    flag = 0;
                }
                i++;
                n++;
            }
            n = 0;
        }
        p = p->next;
    }
    fprintf(file, "}");
}

/* Criar teste para campos corretos */
void testsCorrectField(FILE *file, char *class) {
    VAR *p = SymTabState();
    VAR *p2 = SymTabState();
    int n = 0, flag = 1;
    while (p != NULL) {
        if(p->cData[0] != NULL){
            int i = 0;
            while(i < p->cD) {
                if(i != 0 || flag){
                    fprintf(file, "\t// XXX: Creation test with valid value of field %s %d° option. { %s }\n", p->name, i+1, p->cData[i]);
                    fprintf(file, "\tpublic function %sCorrect%c%sIn%c%sData%d(FunctionalTester $I)\n\t{\n", class, toupper(p->name[0]), &p->name[1], toupper(p->rule[0]), &p->rule[1], n+1);
                    fprintf(file, "\t\t$I->wantTo('The registration occurs correctly for the %s field in the %s rule');\n", p->name, p->rule);
                    fprintf(file, "\t\t$I->amOnRoute('%s/create');\n", rout);
                    fprintf(file, "\t\t$I->submitForm('form',[\n");
                    p2 = SymTabState();
                    while (p2 != NULL) {
                        if(p2->cData[0] == NULL && compare(p2->rule, "required")) {
                            printf("Teste não pode ser concluido pois não ha parametros de dados para todos os atributos required!\n");
                            return;
                        } else if(!compare(p2->name, p->name) && compare(p2->rule, "required")) {
                            fprintf(file, "\t\t\t'%s[%s]' => '%s', \n", class, p2->name, removeCM(p2->cData[0]));
                        } else if(compare(p2->name, p->name) && compare(p2->rule, "required")) {
                            fprintf(file, "\t\t\t'%s[%s]' => '%s', \n", class, p->name, removeCM(p->cData[i]));
                        }
                        p2 = p2->next;
                    }
                    fprintf(file, "\t\t]);\n\t\t$I->seeRecord('app\\models\\%s', [\n", class);
                    p2 = SymTabState();
                    while (p2 != NULL) {
                        if(!compare(p2->name, p->name) && compare(p2->rule, "required")) {
                            fprintf(file, "\t\t\t'%s' => '%s', \n", p2->name, removeCM(p2->cData[0]));
                        } else if(compare(p2->name, p->name) && compare(p2->rule, "required")) {
                            fprintf(file, "\t\t\t'%s' => '%s', \n", p->name, removeCM(p->cData[i]));
                        }
                        p2 = p2->next;
                    }
                    fprintf(file, "\t\t]);\n\t}\n\n");
                    flag = 0;
                }
                n++;
                i++;
            }
        }
        n = 0;
        p = p->next;
    }
    fprintf(file, "}");
}

/* Criar teste para campos incorretos */
void testsBadField(FILE *file, char *class){
    VAR *p = SymTabState();
    VAR *p2 = SymTabState();
    int n = 0, flag = 1;
    while (p != NULL) {
        if(p->iData[0] != NULL){
            int i = 0;
            while(i < p->iD) {
                fprintf(file, "\t// XXX: Creation test with invalid value of field %s %d° option. { %s }\n", p->name, i+1, p->iData[i]);
                fprintf(file, "\tpublic function %sInCorrect%c%sIn%c%sData%d(FunctionalTester $I)\n\t{\n", class, toupper(p->name[0]), &p->name[1], toupper(p->rule[0]), &p->rule[1], n+1);
                fprintf(file, "\t\t$I->wantTo('The registration occurs correctly for the %s field in the %s rule');\n", p->name, p->rule);
                fprintf(file, "\t\t$I->amOnRoute('%s/create');\n", rout);
                fprintf(file, "\t\t$I->submitForm('form',[\n");
                p2 = SymTabState();
                while (p2 != NULL) {
                    if(p2->cData[0] == NULL && compare(p2->rule, "required")) {
                        printf("Teste não pode ser concluido pois não ha parametros de dados para todos os atributos required!\n");
                        return;
                    } else if(!compare(p2->name, p->name) && compare(p2->rule, "required")) {
                        fprintf(file, "\t\t\t'%s[%s]' => '%s', \n", class, p2->name, removeCM(p2->cData[0]));
                    } else if(compare(p2->name, p->name) && compare(p2->rule, "required")) {
                        fprintf(file, "\t\t\t'%s[%s]' => '%s', \n", class, p->name, removeCM(p->iData[i]));
                    }
                    p2 = p2->next;
                }
                fprintf(file, "\t\t]);\n\t\t$I->dontSeeRecord('app\\models\\%s', [\n", class);
                p2 = SymTabState();
                while (p2 != NULL) {
                    if(!compare(p2->name, p->name) && compare(p2->rule, "required")) {
                        fprintf(file, "\t\t\t'%s' => '%s', \n", p2->name, removeCM(p2->cData[0]));
                    } else if(compare(p2->name, p->name) && compare(p2->rule, "required")) {
                        fprintf(file, "\t\t\t'%s' => '%s', \n", p->name, removeCM(p->iData[i]));
                    }
                    p2 = p2->next;
                }
                fprintf(file, "\t\t]);\n\t}\n\n");
                flag = 0;
                n ++;
                i++;
            }
        }
        n = 0;
        p = p->next;
    }
    fprintf(file, "}");
}

/* Criar arquivo de execução dos testes */
void testsExecRun(FILE *file, char *co, char *in, char *del) {
    VAR *p = SymTabState();
    VAR *p2 = SymTabState();
    int n = 0, flag = 1;
    while (p != NULL) {
        if(p->cData[0] != NULL){
            int i = 0;
            while(i < p->cD) {
                if(i != 0 || flag){
                    fprintf(file, "if vendor/bin/codecept run  %s::%sCorrect%c%sIn%c%sData%d --steps; then\n", co, TestClass, toupper(p->name[0]), &p->name[1], toupper(p->rule[0]), &p->rule[1], n+1);
                    fprintf(file, "\tvendor/bin/codecept run  %s::%sDelete%c%sIn%c%sData%d --steps\nfi\n", del, TestClass, toupper(p->name[0]), &p->name[1], toupper(p->rule[0]), &p->rule[1], n+1);
                    flag = 0;
                }
                i++;
            }
        }
        p = p->next;
    }
    fprintf(file, "\nif vendor/bin/codecept run  %s --steps; then\n\techo -n 'Testes executados com sucesso!'\nfi", in);
}

/* Criar todos os arquivos com os tests */
void generateTests(char * correct, char * incorrect, char * delete, char *class) {
    /* Inicializa as variaveis globais com nome da classe e rota */
    TestClass = class;
    toRout(class);
    /* Criar os arquivos temporarios para cada teste */
    FILE *testDelete, *testBadField, *testCorrectField, *runtests, *file, *file2, *file3;
    
    file = fopen(correct, "w");
    file2 = fopen(incorrect, "w");
    file3 = fopen(delete, "w");
    testDelete = fopen("delete.temp", "w");
    testBadField = fopen("bad_field.temp", "w");
    testCorrectField = fopen("correct_field.temp", "w");
    runtests =  fopen("runtests.sh", "w");
    /* Escrita de arquivo de execução dos testes */
    testsExecRun(runtests, correct, incorrect, delete);
    /* Escrita do cabeçalho do arquivo final de teste */
    classPhp(file, class, 1);
    classPhp(file2, class, 2);
    classPhp(file3, class, 3);
    /* Geração dos tempos em arquivos temporarios */
    deleteTest(testDelete, class);
    testsBadField(testBadField, class);
    testsCorrectField(testCorrectField, class);
    fclose(testDelete);
    fclose(testBadField);
    fclose(testCorrectField);
    /* Parte de concatenação dos arquivos finais com temporarios */
    FILE *arq;
    arq = fopen("delete.temp", "rt");
    cat(file3, arq);
    arq = fopen("bad_field.temp", "rt");
    cat(file2, arq);
    arq = fopen("correct_field.temp", "rt");
    cat(file, arq);
    /* Deletar arquivos temporarios */
    remove("delete.temp");
    remove("bad_field.temp");
    remove("correct_field.temp");
}