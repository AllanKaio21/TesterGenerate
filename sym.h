/* (Simple) Symbol Table Definitions */
#pragma once
char *stringpool(char *);
void init_stringpool(int);
#define NEW(type) (type *) calloc(1,sizeof(type))
#define NEW_ARRAY(type,n) (type *) calloc((n),sizeof(type))
#define FREE(p) if (p) free(p)
#define FREE_ARRAY(p) if (p) free(p)
#define REALLOC(p,type,n) (type *) realloc(p,(n)*sizeof(type))
#define REALLOC_ARRAY(p,type,n) (type *) realloc(p,(n)*sizeof(type))
#define MAX 4096

typedef struct VAR {
	char *name;
	char *rule;
	char *cData[MAX];
	char *iData[MAX];
	int cD;
	int iD;
	struct VAR *next;
} VAR;

VAR *MakeVAR(char *, VAR *);
VAR *FindVAR(char *);
VAR *SymTabState();
VAR *inTable(char *);
char *removeCM(char *);
void *AddData(char *, char *, char *);
void AddRule(char *);



