<template>
  <div>
    <a-config-provider :theme="theme" :auto-insert-space-in-button="false">
      <NuxtLayout>
        <NuxtPage />
      </NuxtLayout>

      <!-- Modal Confirm Leave Page -->
      <!-- <MoleculesConfirmModal
        :title="$t('modal.confirm_leave.title')"
        :description="$t('modal.confirm_leave.content')"
        :open="confirmLeaveStore.open"
        :ok-text="$t('btn.leave_page')"
        :is-alert="false"
        @ok="confirmLeaveStore.handleConfirm"
        @cancel="confirmLeaveStore.handleClose"
      /> -->
    </a-config-provider>
  </div>
</template>

<script setup lang="ts">
import { theme as antdTheme } from 'ant-design-vue'

// Stores
// const confirmLeaveStore = useConfirmLeaveStore()

const theme = reactive({
  algorithm: antdTheme.defaultAlgorithm,
})
</script>
