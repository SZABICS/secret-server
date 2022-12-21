# Secret Server Coding Task

## URLs
http://api.secretserverapi.nhely.hu

## Endpoints

I tested the Endpoints in POSTMan, the Swagger tester did not worked because of HTTPS laoding (My endpoints just in HTTP).

---
**http://api.secretserverapi.nhely.hu/v1/secret  POST.**
**http://api.secretserverapi.nhely.hu/v1/secret/-hash-  GET.**

### example for a valid secret's hash: 05e6bbfdf1695038cdb3ce3a6c56ba307edaea4c62d98b09cd4f4e81a0d8c97e.

### (the Accept header must be set to reach data!).
---
**I developed this task in Yii2 framework**

**There are many autogenerated file, but The most important directories i worked in (including but not limited to) are:**
- config
- models
- modules

- some tests