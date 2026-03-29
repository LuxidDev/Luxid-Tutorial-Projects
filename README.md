# Luxid Tutorials

Welcome to the official **Luxid Tutorial Projects** repository — a curated collection of practical example projects built with the Luxid Framework.

This repository is designed to help you learn Luxid by building real applications, not just reading documentation.

---

## What is this?

Luxid Tutorials is a set of **hands-on projects** that demonstrate how to use different parts of the Luxid ecosystem, including:

- Routing and Actions
- Rocket ORM (database & entities)
- Luxid Sentinel (authentication)
- Middleware and request lifecycle
- Frontend integration (Nova, Tailwind)

Each tutorial is a **standalone project** that you can run, explore, and modify.

---

## 📂 Structure

```

luxid-tutorials/
├── 01-Basic-API/
├── 02-Todo-API/
├── 03-Authentication/
├── 04-Nova-UI-With-Tailwind/
├── 05-Server-Side-Rendering/
└── ...

````

Each folder contains:
- A complete Luxid project
- A step-by-step README
- Working code you can run immediately

---

## ⚡ Getting Started

1. Clone the repository:

```bash
git clone https://github.com/Luxid-Dev/luxid-tutorial-projects.git
cd luxid-tutorial-projects
````

2. Navigate into a tutorial:

```bash
cd 02-Authentication
```

3. Install dependencies:

```bash
composer install
```

4. Run migrations:

```bash
php juice db:migrate
```

5. Start the server:

```bash
php juice start
```

---

## 🧪 Tutorials

### 01 - Basic API

Learn the fundamentals of Luxid:

* Routing
* Actions
* JSON Responses

---

### 02 - CRUD API

Strengthen fundamentals from `01-Basic-API` by building a Todo CRUD API:

* CRUD Operations
* API Structure

---

### 03 - Authentication (Sentinel)

Build a complete authentication system:

* Register, login & logout
* Session-based auth
* Protected routes using `auth()`

---

### 04 - Nova UI with Tailwind

Integrate a frontend with Luxid Nova:

* Tailwind CSS (Through CDN)
* Basic UI components`

---

### 05 - Sever-Side Rendering (SSR)

Connecting Nova frontend to backend.

---

## 🧠 Philosophy

This repo focuses on:

* **Learning by doing**
* **Real-world patterns**
* **Clean and elegant syntax**
* **Developer experience (DX)**

---

## 🤝 Contributing

Contributions are welcome!

If you have an idea for a new tutorial or improvement:

1. Fork the repo
2. Create a new tutorial folder
3. Add a clear README
4. Open a pull request

---

## 🔗 Resources

* Luxid Framework Docs: [https://luxid.dev/docs](https://luxid.dev/docs)
* Rocket ORM Docs: [https://luxid.dev/docs/rocket](https://luxid.dev/docs/rocket)

---

## ⚡ Final Note

Luxid is designed to be simple, and powerful.

The best way to learn it is to build with it.

Happy Coding

```

---
