# docker/frontend/Dockerfile
# SMIA Frontend — Node 20 + Angular 17

FROM node:20-alpine AS build

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci --prefer-offline

COPY . .
RUN npm run build -- --configuration=production

# Etapa final: solo los artefactos de build
FROM alpine:3.19
COPY --from=build /app/dist/smia-monica /app/dist/smia-monica
