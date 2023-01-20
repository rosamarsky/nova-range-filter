<template>
    <FilterContainer>
        <span>
            {{ filter.name }}
        </span>

        <template #filter>
            <div class="p-2 flex flex-row items-center">
                <div class="text-xs mr-2">
                    {{ filter.min }}{{ filterLabel }}
                </div>
                <VueSlider class="slider"
                           v-model="value"
                           width="100%"
                           :lazy="true"
                           :min="filter.min"
                           :max="filter.max"
                           :interval="filter.interval"
                           :minRange="filter.minRange"
                           :maxRange="filter.maxRange"
                           :process-style="processStyle"
                           :rail-style="railStyle"
                           :dot-style="dotStyle"
                           :tooltip="filter.tooltip"
                           :tooltip-style="tooltipStyle"
                           :tooltip-formatter="tooltipFormatter"
                           :dot-size="12"
                           :contained="true"
                           :enable-cross="false"
                           :clickable="filter.clickable"
                           :disabled="filter.disabled"
                           :duration="0.3"/>

                <div class="text-xs ml-2">
                    {{ filter.max }}{{ filterLabel }}
                </div>
            </div>
        </template>
    </FilterContainer>
</template>

<script>
import VueSlider from 'vue-slider-component';

export default {
    components: {
        VueSlider,
    },
    props: {
        resourceName: {
            type: String,
            required: true,
        },
        filterKey: {
            type: String,
            required: true,
        },
    },
    emits: ["change"],
    data: () => ({
        processStyle: {
            backgroundColor: 'var(--primary)',
        },
        railStyle: {
            backgroundColor: '#DADEE1',
            borderRadius: '3px',
        },
        dotStyle: {
            border: '1px solid #E7E8E9',
            boxShadow: '0 2px 5px 0 rgba(234,234,234,0.50)',
        },
    }),
    computed: {
        filter() {
            return this.$store.getters[`${this.resourceName}/getFilter`](this.filterKey);
        },
        value: {
            get() {
                return this.filter.currentValue || [this.filter.min, this.filter.max];
            },
            set(sliderValue) {
                this.$store.commit(`${this.resourceName}/updateFilterState`, {
                    filterClass: this.filterKey,
                    value: sliderValue,
                });

                this.$emit('change');
            },
        },
        filterLabel() {
            return this.filter.label ?? '';
        },
        tooltipStyle() {
            const theme = localStorage.getItem('novaTheme');

            return {
                padding: '4px 5px',
                fontSize: '10px',
                marginBottom: '-5px',
                backgroundColor: theme === 'dark' ? '#191919' : '#DADEE1',
                color: theme === 'dark' ?'#FFFFFF' : '#191919',
            };
        },
    },
    methods: {
        tooltipFormatter(value) {
            return `${value}${this.filterLabel}`;
        },
    },
}
</script>
