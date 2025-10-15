#!/usr/bin/env bash
set -e

# ============================
# 🚀 Deploy rápido - Gerador
# ============================

# Cores
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
CYAN='\033[0;36m'
NC='\033[0m' # No Color

# Mensagem do commit
MSG="$1"
if [ -z "$MSG" ]; then
  MSG="auto(Gerador): $(date '+%Y-%m-%d %H:%M:%S')"
fi

echo -e "${CYAN}--------------------------------------------${NC}"
echo -e "${CYAN}🧩 Projeto: Gerador${NC}"
echo -e "${CYAN}--------------------------------------------${NC}"

echo -e "${CYAN}➜ Adicionando alterações...${NC}"
git add .

echo -e "${YELLOW}➜ Commit:${NC} $MSG"
git commit -m "$MSG" || echo -e "${RED}Nada para commitar.${NC}"

echo -e "${CYAN}➜ Enviando para o repositório: origin/main${NC}"
git push origin main

echo -e "${GREEN}✔ Gerador sincronizado com sucesso no GitHub.${NC}"
echo -e "${CYAN}--------------------------------------------${NC}"
