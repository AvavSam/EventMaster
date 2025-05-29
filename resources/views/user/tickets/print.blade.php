<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cetak Tiket</title>
    <style>
      @page {
        size: A4;
        margin: 2cm;
      }

      body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        color: #333;
        margin: 0;
        padding: 0;
      }

      /* Container styles */
      .ticket-container {
        max-width: 42rem;
        margin-left: auto;
        margin-right: auto;
      }

      .ticket-card {
        overflow: hidden;
        border-radius: 0.5rem;
        background-color: white;
        box-shadow:
          0 10px 15px -3px rgba(0, 0, 0, 0.1),
          0 4px 6px -2px rgba(0, 0, 0, 0.05);
      }

      /* Header styles */
      .ticket-header {
        background-color: #2563eb;
        padding: 1rem 1.5rem;
      }

      .header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
      }

      .header-title {
        display: flex;
        align-items: center;
      }

      .ticket-icon {
        height: 2rem;
        width: 2rem;
        color: white;
      }

      .ticket-heading {
        margin-left: 0.5rem;
        font-size: 1.25rem;
        font-weight: bold;
        color: white;
      }

      /* Status badges */
      .status-badge {
        display: inline-flex;
        align-items: center;
        border-radius: 9999px;
        padding: 0.25rem 0.75rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: white;
      }

      .status-paid {
        background-color: #10b981;
      }

      .status-pending {
        background-color: #f59e0b;
      }

      .status-cancelled {
        background-color: #ef4444;
      }

      .status-default {
        background-color: #6b7280;
      }

      /* Section styles */
      .section-border {
        border-bottom: 1px solid #e5e7eb;
        padding: 1.5rem;
      }

      .event-title {
        margin-bottom: 1rem;
        font-size: 1.5rem;
        font-weight: bold;
        color: #111827;
      }

      .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
      }

      .info-grid-larger-gap {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
      }

      .info-item {
        display: flex;
        align-items: center;
        column-gap: 0.5rem;
        color: #4b5563;
      }

      .info-icon {
        height: 1.25rem;
        width: 1.25rem;
        color: #9ca3af;
      }

      .detail-label {
        font-size: 0.875rem;
        color: #6b7280;
      }

      .detail-value {
        font-size: 1.125rem;
        font-weight: 500;
        color: #111827;
      }

      /* QR code section */
      .qr-section {
        padding: 1.5rem;
        text-align: center;
      }

      .qr-container {
        display: inline-block;
        margin-bottom: 1rem;
        border-radius: 0.5rem;
        background-color: #f3f4f6;
        padding: 1rem;
      }

      .qr-code {
        height: 8rem;
        width: 8rem;
      }

      .qr-text {
        font-size: 0.875rem;
        color: #6b7280;
      }

      /* Print button section */
      .print-section {
        background-color: #f9fafb;
        padding: 1.5rem;
      }

      .print-button {
        display: flex;
        width: 100%;
        align-items: center;
        justify-content: center;
        border-radius: 0.375rem;
        border: 1px solid transparent;
        background-color: #2563eb;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: white;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        cursor: pointer;
      }

      .print-button:hover {
        background-color: #1d4ed8;
      }

      .print-button:focus {
        outline: none;
        box-shadow:
          0 0 0 2px #3b82f6,
          0 0 0 4px rgba(59, 130, 246, 0.5);
      }

      .print-icon {
        margin-right: 0.5rem;
        height: 1rem;
        width: 1rem;
      }

      @media print {
        body * {
          visibility: hidden;
        }
        .ticket-container * {
          visibility: visible;
        }
        .ticket-header {
          -webkit-print-color-adjust: exact;
          print-color-adjust: exact;
        }
        .ticket-card {
          box-shadow: none !important;
          border-radius: 0;
        }
        .ticket-container {
          max-width: none;
        }
        .print-section {
          display: none;
        }
      }
    </style>
  </head>

  <body>
    <div class="ticket-container">
      <div class="ticket-card">
        <!-- Ticket Header -->
        <div class="ticket-header">
          <div class="header-content">
            <div class="header-title">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                data-lucide="ticket"
                style="height: 2rem; width: 2rem; color: white"
              >
                <path
                  d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"
                ></path>
                <path d="M13 5v2"></path>
                <path d="M13 17v2"></path>
                <path d="M13 11v2"></path>
              </svg>
              <h1 style="margin-left: 0.5rem; font-size: 1.25rem; font-weight: bold; color: white">E-Ticket</h1>
            </div>
            <div>
              @php
                $statusClass = match ($purchase->status) {
                  'paid' => 'status-paid',
                  'pending' => 'status-pending',
                  'cancelled' => 'status-cancelled',
                  default => 'status-default',
                };
              @endphp

              <span class="status-badge {{ $statusClass }}">
                {{ ucfirst($purchase->status) }}
              </span>
            </div>
          </div>
        </div>

        <!-- Event Details -->
        <div class="section-border">
          <h2 class="event-title">{{ $purchase->event->title }}</h2>

          <div class="info-grid">
            <div class="info-item">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                data-lucide="calendar"
                class="height: 2rem; width: 2rem; color: gray;"
              >
                <path d="M8 2v4"></path>
                <path d="M16 2v4"></path>
                <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                <path d="M3 10h18"></path>
              </svg>
              <span>{{ \Carbon\Carbon::parse($purchase->event->event_date)->format('d M Y H:i') }}</span>
            </div>
            <div class="info-item">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                data-lucide="map-pin"
                class="height: 2rem; width: 2rem; color: gray;"
              >
                <path
                  d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"
                ></path>
                <circle cx="12" cy="10" r="3"></circle>
              </svg>
              <span>{{ $purchase->event->location }}</span>
            </div>
          </div>
        </div>

        <!-- Ticket Details -->
        <div class="section-border">
          <div class="info-grid-larger-gap">
            <div>
              <p class="detail-label">Nama Pembeli</p>
              <p class="detail-value">{{ $purchase->buyer->name }}</p>
            </div>
            <div>
              <p class="detail-label">Jumlah Tiket</p>
              <p class="detail-value">{{ $purchase->qty }} tiket</p>
            </div>
            <div>
              <p class="detail-label">Tanggal Pembelian</p>
              <p class="detail-value">
                {{ \Carbon\Carbon::parse($purchase->purchased_at)->format('d M Y H:i') }}
              </p>
            </div>
            <div>
              <p class="detail-label">Kode Tiket</p>
              <p class="detail-value">{{ $purchase->id }}</p>
            </div>
          </div>
        </div>

        <!-- QR Code -->
        <div class="qr-section">
          <div class="qr-container">
            <img
              src="{{ $purchase->qr_code_url ?? 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . $purchase->id }}"
              alt="QR Code"
              class="qr-code"
            />
          </div>
          <p class="qr-text">Tunjukkan QR Code ini saat check-in event</p>
        </div>

        <!-- Print Button -->
        <div class="print-section">
          <button onclick="window.print()" class="print-button">
            <i data-lucide="printer" class="print-icon"></i>
            Cetak Tiket
          </button>
        </div>
      </div>
    </div>
  </body>
</html>
