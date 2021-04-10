package main

import (
    "net/http"
    "os"
)

func indexHandler(w http.ResponseWriter, r *http.Request) {
    w.Write([]byte("Hello World 5!"))
}

func main() {
    port := os.Getenv("PORT")
    if port == "" {
        port = "3000"
    }

    mux := http.NewServeMux()

    mux.HandleFunc("/", indexHandler)
    http.ListenAndServe(":"+port, mux)
}