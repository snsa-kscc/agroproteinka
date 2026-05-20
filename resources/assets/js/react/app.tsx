import React from "react";
import ReactDOM from "react-dom/client";
import LinkedInFeed from "./components/LinkedInFeed";
import FacebookFeed from "./components/FacebookFeed";
import "./index.css";

const mountComponent = (containerId: string, Component: React.FC) => {
  const container = document.getElementById(containerId);
  if (container) {
    ReactDOM.createRoot(container).render(
      <React.StrictMode>
        <Component />
      </React.StrictMode>
    );
  }
};

if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", () => {
    mountComponent("facebook-posts-container", FacebookFeed);
    mountComponent("linkedin-posts-container", LinkedInFeed);
  });
} else {
  mountComponent("facebook-posts-container", FacebookFeed);
  mountComponent("linkedin-posts-container", LinkedInFeed);
}
