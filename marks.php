import { useEffect, useRef } from 'react';
import * as d3 from 'd3';

export default function MarksTable() {
  const chartRef = useRef(null);

  useEffect(() => {
    if (!chartRef.current) return;

    // Clear any existing content
    d3.select(chartRef.current).selectAll("*").remove();

    // Sample data for the table - 5 marks for each contribution
    const data = [
      { task: "admindash.php", mark: 5, justification: "Efficient admin dashboard interface with secure access controls and user management functionality", internalRoute: "admin/dashboard" },
      { task: "index.php", mark: 5, justification: "Well-structured entry point with responsive design and optimized routing system", internalRoute: "index" },
      { task: "valid_user.php", mark: 5, justification: "Comprehensive user validation with proper security measures against SQL injection and XSS attacks", internalRoute: "valid/user" }
    ];

    // Set up the table dimensions
    const margin = { top: 30, right: 20, bottom: 30, left: 20 };
    const width = 800 - margin.left - margin.right;
    const height = 300 - margin.top - margin.bottom;

    // Create the SVG element
    const svg = d3.select(chartRef.current)
      .append("svg")
      .attr("viewBox", `0 0 ${width + margin.left + margin.right} ${height + margin.top + margin.bottom}`)
      .attr("class", "overflow-visible")
      .append("g")
      .attr("transform", `translate(${margin.left},${margin.top})`);

    // Define column widths
    const colWidths = [150, 80, 350, 150];
    const totalWidth = colWidths.reduce((a, b) => a + b, 0);
    const rowHeight = 50;

    // Create the table header
    const header = svg.append("g")
      .attr("class", "header")
      .attr("transform", "translate(0,0)");

    // Add header background
    header.append("rect")
      .attr("width", totalWidth)
      .attr("height", rowHeight)
      .attr("fill", "#f0f0f0")
      .attr("stroke", "#333")
      .attr("stroke-width", 1);

    // Add header text
    const headers = ["Tasks", "mark", "justification for this marking", "internal route"];
    let xPos = 0;

    headers.forEach((h, i) => {
      header.append("text")
        .attr("x", xPos + colWidths[i] / 2)
        .attr("y", rowHeight / 2)
        .attr("text-anchor", "middle")
        .attr("dominant-baseline", "middle")
        .attr("font-weight", "bold")
        .text(h);

      // Add vertical divider if not the last column
      if (i < headers.length - 1) {
        header.append("line")
          .attr("x1", xPos + colWidths[i])
          .attr("y1", 0)
          .attr("x2", xPos + colWidths[i])
          .attr("y2", rowHeight)
          .attr("stroke", "#333")
          .attr("stroke-width", 1);
      }

      xPos += colWidths[i];
    });

    // Create the table rows
    const rows = svg.selectAll(".row")
      .data(data)
      .enter()
      .append("g")
      .attr("class", "row")
      .attr("transform", (d, i) => `translate(0,${(i + 1) * rowHeight})`);

    // Add row background, alternating colors
    rows.append("rect")
      .attr("width", totalWidth)
      .attr("height", rowHeight)
      .attr("fill", (d, i) => i % 2 === 0 ? "#ffffff" : "#f9f9f9")
      .attr("stroke", "#333")
      .attr("stroke-width", 1);

    // Add row data
    rows.each(function(d, rowIndex) {
      const row = d3.select(this);
      let xPos = 0;
      
      // Add task cell
      row.append("text")
        .attr("x", xPos + colWidths[0] / 2)
        .attr("y", rowHeight / 2)
        .attr("text-anchor", "middle")
        .attr("dominant-baseline", "middle")
        .text(d.task);
      
      // Add vertical divider
      row.append("line")
        .attr("x1", xPos + colWidths[0])
        .attr("y1", 0)
        .attr("x2", xPos + colWidths[0])
        .attr("y2", rowHeight)
        .attr("stroke", "#333")
        .attr("stroke-width", 1);
      
      xPos += colWidths[0];
      
      // Add mark cell
      row.append("text")
        .attr("x", xPos + colWidths[1] / 2)
        .attr("y", rowHeight / 2)
        .attr("text-anchor", "middle")
        .attr("dominant-baseline", "middle")
        .text(d.mark);
      
      // Add vertical divider
      row.append("line")
        .attr("x1", xPos + colWidths[1])
        .attr("y1", 0)
        .attr("x2", xPos + colWidths[1])
        .attr("y2", rowHeight)
        .attr("stroke", "#333")
        .attr("stroke-width", 1);
      
      xPos += colWidths[1];
      
      // Add justification cell with wrapped text
      const justificationText = row.append("text")
        .attr("x", xPos + 10)
        .attr("y", rowHeight / 2)
        .attr("text-anchor", "start")
        .attr("dominant-baseline", "middle");
      
      // Limit text length to prevent overflow
      const maxLength = 45;
      let justification = d.justification;
      if (justification.length > maxLength) {
        justification = justification.substring(0, maxLength) + "...";
      }
      justificationText.text(justification);
      
      // Add vertical divider
      row.append("line")
        .attr("x1", xPos + colWidths[2])
        .attr("y1", 0)
        .attr("x2", xPos + colWidths[2])
        .attr("y2", rowHeight)
        .attr("stroke", "#333")
        .attr("stroke-width", 1);
      
      xPos += colWidths[2];
      
      // Add internal route cell
      row.append("text")
        .attr("x", xPos + colWidths[3] / 2)
        .attr("y", rowHeight / 2)
        .attr("text-anchor", "middle")
        .attr("dominant-baseline", "middle")
        .text(d.internalRoute);
    });

    // Add horizontal divider between header and data
    svg.append("line")
      .attr("x1", 0)
      .attr("y1", rowHeight)
      .attr("x2", totalWidth)
      .attr("y2", rowHeight)
      .attr("stroke", "#333")
      .attr("stroke-width", 2);

  }, []);

  return (
    <div className="flex flex-col items-center w-full p-4">
      <h1 className="text-2xl font-bold mb-6">Marks Evaluation Table</h1>
      <div className="w-full overflow-x-auto">
        <div ref={chartRef} className="w-full"></div>
      </div>
      <div className="mt-6 text-sm text-gray-600">
        <p>This table shows evaluation criteria for your PHP contributions (admindash.php, index.php, valid_user.php)</p>
      </div>
    </div>
  );
}